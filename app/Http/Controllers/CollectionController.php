<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display all categories as collections.
     */
    public function index()
    {
        $categories = Category::withCount('records')->get();

        return view('collections.index', compact('categories'));
    }

    /**
     * Display records belonging to a specific category/collection.
     */
    public function show(string $id)
    {
        $category = Category::with(['records' => function ($query) {
            $query->with('user')->latest();
        }])->withCount('records')->findOrFail($id);

        return view('collections.show', compact('category'));
    }
}
