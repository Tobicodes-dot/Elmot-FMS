<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ELMOT RMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-[#f4f7fb] text-slate-800 overflow-x-hidden">

    <!-- Background Glow -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">

        <div class="absolute top-[-200px] right-[-100px] w-[500px] h-[500px] bg-sky-200 rounded-full blur-3xl opacity-30"></div>

        <div class="absolute bottom-[-200px] left-[-100px] w-[500px] h-[500px] bg-cyan-100 rounded-full blur-3xl opacity-30"></div>

    </div>


    <!-- Navbar -->
    <header class="px-6 md:px-12 py-6">

        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-4">


                    <img 
                        src="{{ asset('images/elmot-header-logo.png') }}"
                        alt="ELMOT Logo"
                        class="w-20 h-20 object-contain"
                    >

                <div>
                    <h1 class="text-xl font-black tracking-tight">
                        ELMOT RMS
                    </h1>

                    <p class="text-sm text-slate-500">
                        Record Management System
                    </p>
                </div>

            </div>


            <!-- Nav -->
            <div class="flex items-center gap-3">

                @auth

                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-3 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">

                        Dashboard

                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="px-5 py-3 rounded-2xl text-slate-600 hover:bg-white transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-5 py-3 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-lg shadow-sky-100 hover:scale-[1.02] transition-all duration-200">
                        Get Started
                    </a>

                @endauth

            </div>

        </div>

    </header>


    <!-- Hero Section -->
    <section class="px-6 md:px-12 pt-12 md:pt-24">

        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center">

            <!-- Left -->
            <div>

                <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100 text-sm text-slate-600 mb-8">

                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                    Smart School Administration

                </div>


                <h1 class="text-5xl md:text-7xl font-black leading-tight tracking-tight">

                    Manage School Records

                    <span class="text-[#01a3e4]">
                        Smarter & Faster
                    </span>

                </h1>


                <p class="mt-8 text-lg text-slate-500 leading-relaxed max-w-xl">

                    ELMOT RMS helps schools securely manage, organize, and access academic records with a clean and modern digital workflow.

                </p>


                <!-- Buttons -->
                <div class="mt-10 flex flex-wrap gap-4">

                    <a href="{{ route('register') }}"
                       class="px-7 py-4 rounded-2xl bg-[#01a3e4] text-white font-semibold shadow-xl shadow-sky-100 hover:scale-[1.03] transition-all duration-200">

                        Get Started

                    </a>

                    <a href="{{ route('login') }}"
                       class="px-7 py-4 rounded-2xl bg-white border border-slate-200 font-semibold hover:bg-slate-50 transition-all duration-200">

                        Login

                    </a>

                </div>

            </div>


            <!-- Right -->
            <div class="relative">

                <!-- Main Card -->
                <div class="bg-white rounded-[32px] shadow-2xl border border-slate-100 p-8">

                    <!-- Top -->
                    <div class="flex items-center justify-between mb-8">

                        <div>
                            <h3 class="font-bold text-xl">
                                School Analytics
                            </h3>

                            <p class="text-slate-400 text-sm mt-1">
                                Live overview
                            </p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-[#01a3e4] text-white flex items-center justify-center">
                            <i data-lucide="bar-chart-3"></i>
                        </div>

                    </div>


                    <!-- Fake Stats -->
                    <div class="grid grid-cols-2 gap-5">

                        <div class="bg-[#f4f7fb] rounded-3xl p-5">
                            <p class="text-slate-400 text-sm">
                                Total Records
                            </p>

                            <h2 class="text-3xl font-black mt-3">
                                12K+
                            </h2>
                        </div>

                        <div class="bg-[#f4f7fb] rounded-3xl p-5">
                            <p class="text-slate-400 text-sm">
                                Active Staff
                            </p>

                            <h2 class="text-3xl font-black mt-3">
                                84
                            </h2>
                        </div>

                        <div class="bg-[#f4f7fb] rounded-3xl p-5">
                            <p class="text-slate-400 text-sm">
                                Departments
                            </p>

                            <h2 class="text-3xl font-black mt-3">
                                16
                            </h2>
                        </div>

                        <div class="bg-[#01a3e4] text-white rounded-3xl p-5">
                            <p class="text-sm text-white/70">
                                System Status
                            </p>

                            <h2 class="text-3xl font-black mt-3">
                                Online
                            </h2>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <script>
        lucide.createIcons();
    </script>

</body>
</html>