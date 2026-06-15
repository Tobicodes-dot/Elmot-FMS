<x-app-layout>

    @section('page-title', $category->name)

    <div class="p-6 md:p-8 space-y-8 overflow-y-auto">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div class="flex items-center gap-4">

                <a href="{{ route('collections.index') }}"
                   class="w-12 h-12 rounded-2xl bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center text-slate-600">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>

                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-800">
                        {{ $category->name }}
                    </h1>

                    <p class="text-slate-500 mt-1 text-base">
                        {{ $category->records_count }} {{ Str::plural('record', $category->records_count) }} in this collection
                    </p>
                </div>

            </div>

            <a href="{{ route('collections.index') }}"
               class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-all duration-200">
                <i data-lucide="layers" class="w-5 h-5"></i>
                All Collections
            </a>

        </div>


        <!-- Records Table -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">

            @if($category->records->count())

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-[#f8fafc]">
                            <tr class="text-left">

                                <th class="px-8 py-5 text-sm font-bold text-slate-500">
                                    File
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

                            @foreach($category->records as $record)

                                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

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

                                                @if($record->description)
                                                    <p class="text-sm text-slate-400 mt-1 max-w-xs truncate">
                                                        {{ $record->description }}
                                                    </p>
                                                @endif
                                            </div>

                                        </div>
                                    </td>

                                    <!-- User -->
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-[#01a3e4] text-white flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($record->user->name ?? 'U', 0, 1)) }}
                                            </div>

                                            <p class="font-semibold text-slate-700">
                                                {{ $record->user->name ?? 'Unknown' }}
                                            </p>

                                        </div>
                                    </td>

                                    <!-- Date -->
                                    <td class="px-8 py-6 text-slate-500 font-medium">
                                        {{ $record->created_at->format('M d, Y') }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-8 py-6">
                                        <div class="flex items-center justify-end gap-3">

                                            <a href="{{ route('records.show', $record->id) }}"
                                               class="w-11 h-11 rounded-xl bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center text-slate-600"
                                               title="Preview">
                                                <i data-lucide="eye" class="w-5 h-5"></i>
                                            </a>

                                            <a href="{{ route('records.download', $record->id) }}"
                                               class="w-11 h-11 rounded-xl bg-sky-100 hover:bg-sky-200 transition flex items-center justify-center text-[#01a3e4]"
                                               title="Download">
                                                <i data-lucide="download" class="w-5 h-5"></i>
                                            </a>

                                        </div>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

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
                        No records have been uploaded to this collection yet.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
