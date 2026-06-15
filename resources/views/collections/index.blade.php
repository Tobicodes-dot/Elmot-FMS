<x-app-layout>

    @section('page-title', 'Collections')

    <div class="p-6 md:p-8 space-y-8 overflow-y-auto">

        <!-- Header -->
        <div>
            <h1 class="text-4xl font-black tracking-tight text-slate-800">
                Collections
            </h1>

            <p class="text-slate-500 mt-2 text-lg">
                Browse records organized by category.
            </p>
        </div>


        <!-- Categories Grid -->
        @if($categories->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @php
                    $colors = [
                        ['bg' => 'bg-sky-100',    'text' => 'text-[#01a3e4]',   'border' => 'border-sky-200',    'icon_bg' => 'bg-sky-200/60'],
                        ['bg' => 'bg-violet-100', 'text' => 'text-violet-600',  'border' => 'border-violet-200', 'icon_bg' => 'bg-violet-200/60'],
                        ['bg' => 'bg-amber-100',  'text' => 'text-amber-600',   'border' => 'border-amber-200',  'icon_bg' => 'bg-amber-200/60'],
                        ['bg' => 'bg-emerald-100','text' => 'text-emerald-600', 'border' => 'border-emerald-200','icon_bg' => 'bg-emerald-200/60'],
                        ['bg' => 'bg-rose-100',   'text' => 'text-rose-600',    'border' => 'border-rose-200',   'icon_bg' => 'bg-rose-200/60'],
                        ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-600',  'border' => 'border-indigo-200', 'icon_bg' => 'bg-indigo-200/60'],
                    ];
                @endphp

                @foreach($categories as $index => $category)

                    @php $color = $colors[$index % count($colors)]; @endphp

                    <a href="{{ route('collections.show', $category->id) }}"
                       class="group bg-white rounded-[28px] border border-slate-100 p-6 shadow-sm hover:shadow-xl hover:scale-[1.02] transition-all duration-300">

                        <!-- Icon -->
                        <div class="w-16 h-16 rounded-2xl {{ $color['bg'] }} {{ $color['text'] }} flex items-center justify-center mb-5">
                            <i data-lucide="folder" class="w-7 h-7"></i>
                        </div>

                        <!-- Name -->
                        <h3 class="text-xl font-black text-slate-800 group-hover:text-[#01a3e4] transition-colors">
                            {{ $category->name }}
                        </h3>

                        <!-- Count -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-slate-400 text-sm font-medium">
                                {{ $category->records_count }} {{ Str::plural('record', $category->records_count) }}
                            </span>

                            <div class="w-8 h-8 rounded-xl bg-slate-100 group-hover:bg-[#01a3e4] group-hover:text-white flex items-center justify-center text-slate-400 transition-all duration-300">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </div>
                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <!-- Empty State -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm py-24 px-6 text-center">

                <div class="w-24 h-24 rounded-[28px] bg-slate-100 flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="layers" class="w-10 h-10 text-slate-400"></i>
                </div>

                <h3 class="text-2xl font-black text-slate-800">
                    No Collections Yet
                </h3>

                <p class="text-slate-400 mt-3 max-w-md mx-auto">
                    Categories will appear here once they are created by an administrator.
                </p>

            </div>

        @endif

    </div>

</x-app-layout>
