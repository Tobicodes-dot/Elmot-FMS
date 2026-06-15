<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Record::with(['category', 'user'])->latest();

        // Search by title
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $records = $query->get();

        $categories = Category::all();

        return view('records.index', compact('records', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('records.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:20480', // 20MB max
            'category_id' => 'required|exists:categories,id'
        ]);

        // STORE FILE
        $path = $request->file('file')->store('records', 'public');

        // SAVE TO DATABASE
        Record::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'category_id' => $request->category_id,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('records.index')
            ->with('success', 'Record uploaded successfully');
    }

    public function download($id)
    {
        $record = Record::findOrFail($id);

        return Storage::disk('public')->download($record->file_path);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = Record::with(['category', 'user'])->findOrFail($id);

        return view('records.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Record::findOrFail($id);

        // Delete file from storage
        Storage::disk('public')->delete($record->file_path);

        // Delete record from DB
        $record->delete();

        return redirect()->route('records.index')
            ->with('success', 'Record deleted successfully');
    }
}
