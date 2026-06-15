<x-app-layout>

    @section('page-title', $record->title)

    <div class="p-6 md:p-8 space-y-8 overflow-y-auto">

        <!-- Back + Actions Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div class="flex items-center gap-4">

                <a href="{{ route('records.index') }}"
                   class="w-12 h-12 rounded-2xl bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center text-slate-600">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>

                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-800">
                        {{ $record->title }}
                    </h1>

                    <p class="text-slate-500 mt-1 text-base">
                        Uploaded {{ $record->created_at->diffForHumans() }}
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('records.download', $record->id) }}"
                   class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">
                    <i data-lucide="download" class="w-5 h-5"></i>
                    Download File
                </a>

                <a href="{{ route('records.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    Back
                </a>

            </div>

        </div>


        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- File Preview -->
            <div class="xl:col-span-2 bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">

                <div class="px-8 py-6 border-b border-slate-100">
                    <h2 class="text-xl font-black text-slate-800">
                        File Preview
                    </h2>
                </div>

                <div class="p-6">

                    @php
                        $extension = strtolower(pathinfo($record->file_path, PATHINFO_EXTENSION));
                        $fileUrl = asset('storage/' . $record->file_path);
                    @endphp

                    @if(in_array($extension, ['pdf']))

                        <!-- PDF Preview -->
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <iframe
                                src="{{ $fileUrl }}"
                                class="w-full rounded-2xl"
                                style="height: 700px;"
                                frameborder="0">
                            </iframe>
                        </div>

                    @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']))

                        <!-- Image Preview -->
                        <div class="flex items-center justify-center rounded-2xl bg-slate-50 border border-slate-200 p-6">
                            <img
                                src="{{ $fileUrl }}"
                                alt="{{ $record->title }}"
                                class="max-w-full max-h-[600px] rounded-xl object-contain shadow-lg"
                            >
                        </div>

                    @elseif(in_array($extension, ['doc', 'docx']))

                        <!-- Word Document Preview via Google Docs Viewer -->
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <iframe
                                src="https://docs.google.com/viewer?url={{ urlencode($fileUrl) }}&embedded=true"
                                class="w-full rounded-2xl"
                                style="height: 700px;"
                                frameborder="0">
                            </iframe>
                        </div>

                    @elseif(in_array($extension, ['xls', 'xlsx', 'csv']))

                        <!-- Spreadsheet Preview via Google Docs Viewer -->
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <iframe
                                src="https://docs.google.com/viewer?url={{ urlencode($fileUrl) }}&embedded=true"
                                class="w-full rounded-2xl"
                                style="height: 700px;"
                                frameborder="0">
                            </iframe>
                        </div>

                    @elseif(in_array($extension, ['ppt', 'pptx']))

                        <!-- PowerPoint Preview via Google Docs Viewer -->
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <iframe
                                src="https://docs.google.com/viewer?url={{ urlencode($fileUrl) }}&embedded=true"
                                class="w-full rounded-2xl"
                                style="height: 700px;"
                                frameborder="0">
                            </iframe>
                        </div>

                    @elseif(in_array($extension, ['txt', 'md', 'log', 'json', 'xml', 'html', 'css', 'js', 'php', 'py']))

                        <!-- Text File Preview -->
                        <div class="rounded-2xl bg-slate-900 border border-slate-700 p-6 overflow-auto" style="max-height: 700px;">
                            <pre class="text-sm text-slate-200 font-mono whitespace-pre-wrap">{{ \Illuminate\Support\Facades\Storage::disk('public')->get($record->file_path) }}</pre>
                        </div>

                    @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))

                        <!-- Video Preview -->
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-black">
                            <video controls class="w-full rounded-2xl" style="max-height: 700px;">
                                <source src="{{ $fileUrl }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                    @elseif(in_array($extension, ['mp3', 'wav', 'ogg']))

                        <!-- Audio Preview -->
                        <div class="rounded-2xl bg-slate-50 border border-slate-200 p-12 flex flex-col items-center justify-center gap-6">
                            <div class="w-24 h-24 rounded-[28px] bg-sky-100 flex items-center justify-center">
                                <i data-lucide="music" class="w-10 h-10 text-[#01a3e4]"></i>
                            </div>
                            <audio controls class="w-full max-w-lg">
                                <source src="{{ $fileUrl }}" type="audio/{{ $extension }}">
                                Your browser does not support the audio element.
                            </audio>
                        </div>

                    @else

                        <!-- Unsupported Format -->
                        <div class="py-20 text-center rounded-2xl bg-slate-50 border border-slate-200">

                            <div class="w-24 h-24 rounded-[28px] bg-slate-100 flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="file" class="w-10 h-10 text-slate-400"></i>
                            </div>

                            <h3 class="text-2xl font-black text-slate-800">
                                Preview not available
                            </h3>

                            <p class="text-slate-400 mt-3 max-w-md mx-auto">
                                This file type (.{{ $extension }}) cannot be previewed in the browser. Please download it to view.
                            </p>

                            <a href="{{ route('records.download', $record->id) }}"
                               class="inline-flex items-center gap-3 mt-8 px-6 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">
                                <i data-lucide="download" class="w-5 h-5"></i>
                                Download File
                            </a>

                        </div>

                    @endif

                </div>

            </div>


            <!-- File Details Sidebar -->
            <div class="space-y-6">

                <!-- File Info Card -->
                <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm overflow-hidden">

                    <div class="px-7 py-5 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">
                            File Details
                        </h3>
                    </div>

                    <div class="p-7 space-y-6">

                        <!-- Title -->
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Title</p>
                            <p class="text-slate-800 font-semibold text-lg">{{ $record->title }}</p>
                        </div>

                        <!-- Description -->
                        @if($record->description)
                            <div>
                                <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</p>
                                <p class="text-slate-600 leading-relaxed">{{ $record->description }}</p>
                            </div>
                        @endif

                        <!-- Category -->
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Category</p>
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-sky-100 text-[#01a3e4] text-sm font-semibold">
                                {{ $record->category->name ?? 'General' }}
                            </span>
                        </div>

                        <!-- File Type -->
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">File Type</p>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#01a3e4] flex items-center justify-center">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                </div>
                                <span class="font-semibold text-slate-700 uppercase">.{{ $extension }}</span>
                            </div>
                        </div>

                        <!-- File Size -->
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">File Size</p>
                            @php
                                $sizeBytes = \Illuminate\Support\Facades\Storage::disk('public')->size($record->file_path);
                                if ($sizeBytes >= 1048576) {
                                    $sizeFormatted = number_format($sizeBytes / 1048576, 2) . ' MB';
                                } elseif ($sizeBytes >= 1024) {
                                    $sizeFormatted = number_format($sizeBytes / 1024, 2) . ' KB';
                                } else {
                                    $sizeFormatted = $sizeBytes . ' bytes';
                                }
                            @endphp
                            <p class="text-slate-700 font-semibold">{{ $sizeFormatted }}</p>
                        </div>

                    </div>

                </div>


                <!-- Uploaded By Card -->
                <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm overflow-hidden">

                    <div class="px-7 py-5 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">
                            Uploaded By
                        </h3>
                    </div>

                    <div class="p-7">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-[#01a3e4] text-white flex items-center justify-center font-bold text-xl">
                                {{ strtoupper(substr($record->user->name ?? 'U', 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-bold text-slate-800 text-lg">
                                    {{ $record->user->name ?? 'Unknown' }}
                                </p>
                                <p class="text-slate-400 text-sm mt-1">
                                    {{ $record->created_at->format('M d, Y \a\t h:i A') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                <!-- Quick Actions Card -->
                <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm overflow-hidden">

                    <div class="px-7 py-5 border-b border-slate-100">
                        <h3 class="text-lg font-black text-slate-800">
                            Quick Actions
                        </h3>
                    </div>

                    <div class="p-7 space-y-3">

                        <a href="{{ route('records.download', $record->id) }}"
                           class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-sky-50 hover:bg-sky-100 transition-all duration-200 text-[#01a3e4] font-semibold">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center">
                                <i data-lucide="download" class="w-5 h-5"></i>
                            </div>
                            Download File
                        </a>

                        @if(auth()->user()->isAdmin())
                            <form action="{{ route('records.destroy', $record->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this record? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl bg-red-50 hover:bg-red-100 transition-all duration-200 text-red-500 font-semibold">
                                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </div>
                                    Delete Record
                                </button>
                            </form>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
