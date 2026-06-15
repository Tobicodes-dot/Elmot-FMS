<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>ELMOT RMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

<div class="flex h-screen bg-[#f4f7fb] p-4 gap-4">

    <!-- Sidebar -->
    <aside
        class="hidden md:flex w-72 bg-white/80 backdrop-blur-xl border border-white/40 rounded-none md:rounded-[32px] shadow-2xl flex-col overflow-hidden
        transform transition-transform duration-300"
        :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    >

        <!-- Logo -->
        <div class="px-7 pt-8 pb-6">

            <div class="flex items-center gap-4">
                
                <img 
                    src="{{ asset('images/elmot-header-logo.png') }}" 
                    alt="ELMOT Logo"
                    class="w-16 h-16 object-contain"
                >


                <div>
                    <h1 class="text-xl font-black text-slate-800 tracking-tight">
                        ELMOT RMS
                    </h1>

                    <p class="text-slate-400 text-sm mt-1">
                        School Management
                    </p>
                </div>

            </div>

        </div>


        <!-- Navigation -->
        <nav class="flex-1 px-5 space-y-3">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-200
                {{ request()->routeIs('dashboard') 
                ? 'bg-[#01a3e4] text-white shadow-lg shadow-sky-100' 
                : 'hover:bg-slate-100 text-slate-700' }}">

                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                    {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-slate-100' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                </div>

                <span class="font-semibold text-[15px]">
                    Dashboard
                </span>

            </a>


            <!-- Records -->
            <a href="{{ route('records.index') }}"
                class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-200
                {{ request()->routeIs('records.index') 
                ? 'bg-[#01a3e4] text-white shadow-lg shadow-sky-100' 
                : 'hover:bg-slate-100 text-slate-700' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                    {{ request()->routeIs('records.*') ? 'bg-white/20' : 'bg-slate-100' }}">
                    <i data-lucide="folder" class="w-5 h-5"></i>
                </div>

                <span class="font-semibold text-[15px]">
                    Records
                </span>

            </a>


            <!-- Collections -->
            <a href="{{ route('collections.index') }}"
                class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-200
                {{ request()->routeIs('collections.*')
                ? 'bg-[#01a3e4] text-white shadow-lg shadow-sky-100'
                : 'hover:bg-slate-100 text-slate-700' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                    {{ request()->routeIs('collections.*') ? 'bg-white/20' : 'bg-slate-100' }}">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>

                <span class="font-semibold text-[15px]">
                    Collections
                </span>

            </a>


            
                <!-- Upload -->
                <a href="{{ route('records.create') }}"
                class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-200
                {{ request()->routeIs('records.create')
                ? 'bg-[#01a3e4] text-white shadow-lg shadow-sky-100'
                : 'hover:bg-slate-100 text-slate-700' }}">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center
                        {{ request()->routeIs('records.create') ? 'bg-white/20' : 'bg-slate-100' }}">
                        <i data-lucide="upload" class="w-5 h-5"></i>
                    </div>

                    <span class="font-semibold text-[15px]">
                        Upload Record
                    </span>
                </a>


        </nav>


        <!-- Bottom User Card -->
        <div class="p-5">

            <div class="bg-[#f4f7fb] rounded-3xl p-4">

                <div class="flex items-center gap-3">

                    <!-- Avatar -->
                    <div class="w-12 h-12 rounded-2xl bg-[#01a3e4] flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </h3>

                        <p class="text-sm text-slate-400 capitalize">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                </div>


                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf

                    <button class="flex items-center justify-center gap-2 w-full bg-white hover:bg-slate-100 transition text-slate-700 font-semibold py-3 rounded-2xl border border-slate-200">

                        <i data-lucide="log-out" class="w-4 h-4"></i>

                        Logout
                    </button>
                </form>

            </div>

        </div>

    </aside>

    <!-- Main -->
    <div class="flex-1 bg-white rounded-[32px] shadow-xl overflow-hidden flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow-sm border-b px-8 py-4 flex justify-between items-center">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    ELMOT School Record Management System
                </h2>

                <p class="text-sm text-slate-500">
                    Manage school documents and records efficiently
                </p>
            </div>

            <div class="text-sm text-slate-500">
                {{ now()->format('d M Y') }}
            </div>

        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-8">
            {{ $slot }}
        </main>

    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="md:hidden fixed bottom-4 left-4 right-4 z-50">
    <div class="relative">
    
        <div class="bg-white/90 backdrop-blur-xl border border-slate-100 shadow-xl rounded-2xl px-4 py-3 flex items-center justify-between">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
            class="flex flex-col items-center gap-1 text-xs
            {{ request()->routeIs('dashboard') ? 'text-[#01a3e4]' : 'text-slate-500' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Home</span>
            </a>

            <!-- Records -->
            <a href="{{ route('records.index') }}"
            class="flex flex-col items-center gap-1 text-xs
            {{ request()->routeIs('records.*') ? 'text-[#01a3e4]' : 'text-slate-500' }}">
                <i data-lucide="folder" class="w-5 h-5"></i>
                <span>Records</span>
            </a>

            <!-- Collections -->
            <a href="{{ route('collections.index') }}"
            class="flex flex-col items-center gap-1 text-xs
            {{ request()->routeIs('collections.*') ? 'text-[#01a3e4]' : 'text-slate-500' }}">
                <i data-lucide="layers" class="w-5 h-5"></i>
                <span>Collections</span>
            </a>

            <!-- Upload (admin only) -->
            @if(auth()->user()->isAdmin())
            <a href="{{ route('records.create') }}"
            class="flex flex-col items-center gap-1 text-xs text-slate-600">
                <i data-lucide="upload" class="w-5 h-5"></i>
                <span>Upload</span>
            </a>
            @endif

            <!-- Profile -->
            <div class="flex flex-col items-center gap-1 text-xs text-slate-600">
                <div class="w-6 h-6 rounded-full bg-[#01a3e4] text-white flex items-center justify-center text-[10px] font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span>Me</span>
            </div>

        </div>

</div>
    </div>

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>