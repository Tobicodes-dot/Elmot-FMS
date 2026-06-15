<x-app-layout>

    @section('page-title', 'Records')

    <div class="p-6 md:p-8 space-y-8 overflow-y-auto">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>
                <h1 class="text-4xl font-black tracking-tight text-slate-800">
                    Records Management
                </h1>

                <p class="text-slate-500 mt-2 text-lg">
                    Organize and manage academic records efficiently.
                </p>
            </div>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('records.create') }}"
                   class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">

                    <i data-lucide="plus"></i>

                    Upload Record
                </a>
            @endif

        </div>


        <!-- Search + Filters -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-5">

            <form method="GET" action="{{ route('records.index') }}" id="filterForm">

                <div class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

                    <!-- Search -->
                    <div class="relative flex-1">

                        <i data-lucide="search"
                           class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>

                        <input
                            type="text"
                            id="recordSearch"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search records..."
                            class="w-full pl-12 pr-5 py-4 rounded-2xl border border-slate-200 bg-[#f8fafc] focus:border-[#01a3e4] focus:ring focus:ring-[#01a3e4]/20 focus:outline-none"
                        >

                    </div>


                    <!-- Category Filter -->
                    <div class="relative min-w-[220px]">

                        <!-- Icon -->
                        <i data-lucide="sliders-horizontal"
                           class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none">
                        </i>

                        <select
                            id="categoryFilter"
                            name="category_id"
                            class="w-full pl-12 pr-10 py-4 rounded-2xl border border-slate-200 bg-[#f8fafc] focus:border-[#01a3e4] focus:ring focus:ring-[#01a3e4]/20 focus:outline-none appearance-none"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Dropdown Arrow -->
                        <i data-lucide="chevron-down"
                           class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none">
                        </i>

                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-sm hover:scale-[1.02] transition-all duration-200 whitespace-nowrap">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Search
                    </button>

                    @if(request('search') || request('category_id'))
                        <a href="{{ route('records.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-4 rounded-2xl border border-slate-200 text-slate-500 font-semibold hover:bg-slate-50 transition-all duration-200 whitespace-nowrap">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Clear
                        </a>
                    @endif

                </div>

            </form>

        </div>


        <!-- Records Table -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">

            <!-- Table Header -->
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">

                <div>
                    <h2 class="text-2xl font-black text-slate-800">
                        All Records
                    </h2>

                    <p class="text-slate-400 mt-1">
                        Uploaded academic files and documents
                    </p>
                </div>

                <div class="hidden md:flex items-center gap-2 text-sm text-slate-400">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    Total: {{ $records->count() }}
                </div>

            </div>


            @if($records->count())

                <!-- Table -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-[#f8fafc]">

                            <tr class="text-left">

                                <th class="px-8 py-5 text-sm font-bold text-slate-500">
                                    File
                                </th>

                                <th class="px-8 py-5 text-sm font-bold text-slate-500">
                                    Category
                                </th>

                                <th class="px-8 py-5 text-sm font-bold text-slate-500">
                                    Uploaded By
                                </th>

                                <th class="px-8 py-5 text-sm font-bold text-slate-500">
                                    Date
                                </th>

                                <th class="px-8 py-5 text-sm font-bold text-slate-500 text-right">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($records as $record)

                                <tr
                                    class="record-row border-t border-slate-100 hover:bg-slate-50 transition"
                                    data-title="{{ strtolower($record->title) }}"
                                    data-category="{{ strtolower($record->category->name ?? 'general') }}"
                                    data-category-id="{{ $record->category_id }}"
                                    data-user="{{ strtolower($record->user->name ?? 'unknown') }}"
                                >

                                    <!-- File -->
                                    <td class="px-8 py-6">

                                        <div class="flex items-center gap-4">

                                            <div class="w-14 h-14 rounded-2xl bg-sky-100 text-[#01a3e4] flex items-center justify-center">
                                                <i data-lucide="file-text"></i>
                                            </div>

                                            <div>

                                                <h3 class="font-bold text-slate-800">
                                                    {{ $record->title }}
                                                </h3>

                                                <p class="text-sm text-slate-400 mt-1">
                                                    Academic document
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    <!-- Category -->
                                    <td class="px-8 py-6">

                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-sky-100 text-[#01a3e4] text-sm font-semibold">
                                            {{ $record->category->name ?? 'General' }}
                                        </span>

                                    </td>


                                    <!-- User -->
                                    <td class="px-8 py-6">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-[#01a3e4] text-white flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($record->user->name ?? 'U', 0, 1)) }}
                                            </div>

                                            <div>

                                                <p class="font-semibold text-slate-700">
                                                    {{ $record->user->name ?? 'Unknown' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    <!-- Date -->
                                    <td class="px-8 py-6 text-slate-500 font-medium">

                                        {{ $record->created_at->format('M d, Y') }}

                                    </td>


                                    <!-- Actions -->
                                    <td class="px-8 py-6">

                                        <div class="flex items-center justify-end gap-3">

                                            <!-- View / Preview -->
                                            <a href="{{ route('records.show', $record->id) }}"
                                               class="w-11 h-11 rounded-xl bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center text-slate-600"
                                               title="Preview">

                                                <i data-lucide="eye" class="w-5 h-5"></i>

                                            </a>


                                            <!-- Download -->
                                            <a href="{{ route('records.download', $record->id) }}"
                                               class="w-11 h-11 rounded-xl bg-sky-100 hover:bg-sky-200 transition flex items-center justify-center text-[#01a3e4]"
                                               title="Download">

                                                <i data-lucide="download" class="w-5 h-5"></i>

                                            </a>


                                            @if(auth()->user()->isAdmin())

                                                <!-- Delete -->
                                                <form action="{{ route('records.destroy', $record->id) }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="w-11 h-11 rounded-xl bg-red-100 hover:bg-red-200 transition flex items-center justify-center text-red-500"
                                                        title="Delete">

                                                        <i data-lucide="trash-2" class="w-5 h-5"></i>

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                        <tr id="noResults" class="hidden">
                            <td colspan="5" class="py-16 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="w-20 h-20 rounded-[24px] bg-slate-100 flex items-center justify-center mb-5">
                                        <i data-lucide="search-x" class="w-8 h-8 text-slate-400"></i>
                                    </div>

                                    <h3 class="text-2xl font-black text-slate-800">
                                        No matching records
                                    </h3>

                                    <p class="text-slate-400 mt-2">
                                        Try another keyword or category.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    </table>

                </div>

            @else

                <!-- Empty State -->
                <div class="py-24 px-6 text-center">

                    <div class="w-24 h-24 rounded-[28px] bg-slate-100 flex items-center justify-center mx-auto mb-6">

                        <i data-lucide="folder-open" class="w-10 h-10 text-slate-400"></i>

                    </div>

                    <h3 class="text-2xl font-black text-slate-800">
                        No Records Yet
                    </h3>

                    <p class="text-slate-400 mt-3 max-w-md mx-auto">
                        Uploaded records will appear here once staff members begin adding files.
                    </p>

                    @if(auth()->user()->isAdmin())

                        <a href="{{ route('records.create') }}"
                           class="inline-flex items-center gap-3 mt-8 px-6 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">

                            <i data-lucide="plus"></i>

                            Upload First Record

                        </a>

                    @endif

                </div>

            @endif

        </div>

    </div>

    <script>

    document.addEventListener('DOMContentLoaded', () => {

        const searchInput  = document.getElementById('recordSearch');
        const categoryFilter = document.getElementById('categoryFilter');
        const filterForm   = document.getElementById('filterForm');

        // Submit form automatically when category changes
        if (categoryFilter) {
            categoryFilter.addEventListener('change', () => {
                filterForm.submit();
            });
        }

        // Submit form on Enter key in search input
        if (searchInput) {
            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    filterForm.submit();
                }
            });
        }

    });


</script>

</x-app-layout>