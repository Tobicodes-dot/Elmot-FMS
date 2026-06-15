

<x-app-layout>

    @section('page-title', 'Dashboard')

    <div class="p-6 md:p-8 space-y-8 overflow-y-auto">

        <!-- Welcome -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-4xl font-black tracking-tight text-slate-800">
                    Welcome back,
                    <span class="text-[#01a3e4]">
                        {{ auth()->user()->name }}
                    </span>
                </h1>

                <p class="text-slate-500 mt-2 text-lg">
                    Here’s what’s happening in ELMOT RMS today.
                </p>
            </div>

            <!-- Quick Action -->
            @if(auth()->user()->isAdmin())
                <a href="{{ route('records.create') }}"
                   class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">

                    <i data-lucide="plus"></i>

                    Upload Record
                </a>
            @endif

        </div>


        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- Card -->
            <div class="bg-white rounded-[28px] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-slate-400 text-sm font-medium">
                            Total Records
                        </p>

                        <h2 class="text-4xl font-black mt-4 text-slate-800">
                           {{ \App\Models\Record::count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-sky-100 text-[#01a3e4] flex items-center justify-center">
                        <i data-lucide="folder"></i>
                    </div>

                </div>

                <div class="mt-6 flex items-center gap-2 text-green-500 text-sm font-medium">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                    +12% this month
                </div>

            </div>


            <!-- Card -->
            <div class="bg-white rounded-[28px] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-slate-400 text-sm font-medium">
                            Today's Uploads
                        </p>

                        <h2 class="text-4xl font-black mt-4 text-slate-800">
                            {{ $todayUploads }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-violet-100 text-violet-600 flex items-center justify-center">
                        <i data-lucide="upload"></i>
                    </div>

                </div>

                <div class="mt-6 flex items-center gap-2 text-slate-400 text-sm font-medium">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    {{ now()->format('M d, Y') }}
                </div>

            </div>


            <!-- Card -->
            <div class="bg-white rounded-[28px] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-slate-400 text-sm font-medium">
                            Categories
                        </p>

                        <h2 class="text-4xl font-black mt-4 text-slate-800">
                            {{ \App\Models\Category::count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center">
                        <i data-lucide="layers"></i>
                    </div>

                </div>

                <div class="mt-6 flex items-center gap-2 text-slate-500 text-sm font-medium">
                    Organized collections
                </div>

            </div>


            <!-- Card: System Status (live network detection) -->
            <div id="statusCard" class="rounded-[28px] p-6 shadow-xl transition-colors duration-500 text-white"
                 style="background-color: #01a3e4;">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-white/70 text-sm font-medium">
                            System Status
                        </p>

                        <h2 id="statusText" class="text-4xl font-black mt-4">
                            Online
                        </h2>
                    </div>

                    <div id="statusIconWrap" class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center">
                        <i id="statusIconOnline" data-lucide="shield-check"></i>
                        <i id="statusIconOffline" data-lucide="wifi-off" class="hidden"></i>
                    </div>

                </div>

                <div id="statusSubtext" class="mt-6 flex items-center gap-2 text-sm font-medium text-white/80">
                    <span id="statusDot" class="w-2 h-2 rounded-full bg-green-300 inline-block"></span>
                    All services operational
                </div>

            </div>

            <script>
                (function() {
                    function updateStatus() {
                        const online        = navigator.onLine;
                        const card          = document.getElementById('statusCard');
                        const text          = document.getElementById('statusText');
                        const subtext       = document.getElementById('statusSubtext');
                        const dot           = document.getElementById('statusDot');
                        const iconOnline    = document.getElementById('statusIconOnline');
                        const iconOffline   = document.getElementById('statusIconOffline');

                        if (online) {
                            card.style.backgroundColor = '#01a3e4';
                            text.textContent = 'Online';
                            dot.className = 'w-2 h-2 rounded-full bg-green-300 inline-block';
                            subtext.lastChild.textContent = ' All services operational';
                            iconOnline.classList.remove('hidden');
                            iconOffline.classList.add('hidden');
                        } else {
                            card.style.backgroundColor = '#ef4444';
                            text.textContent = 'Offline';
                            dot.className = 'w-2 h-2 rounded-full bg-red-300 animate-pulse inline-block';
                            subtext.lastChild.textContent = ' No network connection';
                            iconOnline.classList.add('hidden');
                            iconOffline.classList.remove('hidden');
                        }

                        // Re-render lucide icons for the newly visible icon
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }

                    window.addEventListener('online',  updateStatus);
                    window.addEventListener('offline', updateStatus);
                    document.addEventListener('DOMContentLoaded', updateStatus);
                })();
            </script>

        </div>


        <!-- Bottom Grid -->
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Recent Activity -->
            <div class="lg:col-span-2 bg-white rounded-[32px] border border-slate-100 p-7 shadow-sm">

                <div class="flex items-center justify-between mb-8">

                    <div>
                        <h3 class="text-2xl font-black text-slate-800">
                            Recent Activity
                        </h3>

                        <p class="text-slate-400 mt-1">
                            Latest actions in the system
                        </p>
                    </div>

                    <a href="{{ route('records.index') }}" class="text-[#01a3e4] font-semibold hover:underline">
                        View All
                    </a>

                </div>


                <!-- Activities -->
                <div class="space-y-5">

                    @forelse($recentRecords as $recent)

                        <a href="{{ route('records.show', $recent->id) }}"
                           class="flex items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 transition">

                            <div class="w-12 h-12 rounded-2xl bg-sky-100 text-[#01a3e4] flex items-center justify-center">
                                <i data-lucide="file-text"></i>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-slate-800 truncate">
                                    {{ $recent->title }}
                                </h4>

                                <p class="text-sm text-slate-400 mt-1">
                                    Uploaded by {{ $recent->user->name ?? 'Unknown' }} · {{ $recent->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full bg-sky-50 text-[#01a3e4] text-xs font-semibold whitespace-nowrap">
                                {{ $recent->category->name ?? 'General' }}
                            </span>

                        </a>

                    @empty

                        <div class="py-10 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="inbox" class="w-6 h-6 text-slate-400"></i>
                            </div>
                            <p class="text-slate-400 font-medium">No recent activity yet</p>
                        </div>

                    @endforelse

                </div>

            </div>


            <!-- Quick Access -->
            <div class="bg-white rounded-[32px] border border-slate-100 p-7 shadow-sm">

                <h3 class="text-2xl font-black text-slate-800">
                    Quick Access
                </h3>

                <p class="text-slate-400 mt-1 mb-8">
                    Common actions
                </p>


                <div class="space-y-4">

                    <a href="{{ route('records.index') }}"
                       class="flex items-center justify-between p-5 rounded-2xl bg-[#f4f7fb] hover:bg-slate-100 transition">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-sm">
                                <i data-lucide="folder"></i>
                            </div>

                            <div>
                                <h4 class="font-semibold text-slate-800">
                                    View Records
                                </h4>

                                <p class="text-sm text-slate-400">
                                    Browse uploaded files
                                </p>
                            </div>

                        </div>

                        <i data-lucide="arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>