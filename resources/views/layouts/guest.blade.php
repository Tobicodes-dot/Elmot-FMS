<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ELMOT RMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="min-h-screen bg-[#f4f7fb] overflow-hidden relative">

    <!-- Background Glow -->
    <div class="absolute inset-0 -z-10 overflow-hidden">

        <div class="absolute top-[-150px] right-[-100px] w-[450px] h-[450px] bg-sky-200 rounded-full blur-3xl opacity-30"></div>

        <div class="absolute bottom-[-150px] left-[-100px] w-[450px] h-[450px] bg-cyan-100 rounded-full blur-3xl opacity-30"></div>

    </div>


    <div class="min-h-screen flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-6xl grid lg:grid-cols-2 overflow-hidden rounded-[40px] shadow-2xl border border-white/40 backdrop-blur-xl bg-white/70">

            <!-- Left Side -->
            <div class="hidden lg:flex flex-col justify-between p-12 bg-[#01a3e4] text-white relative overflow-hidden">

                <!-- Decorative Glow -->
                <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

                <!-- Logo -->
                <div class="relative z-10">

                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 rounded-3xl bg-white flex items-center justify-center p-3 shadow-xl">

                            <img 
                                src="{{ asset('images/elmot-header-logo.png') }}"
                                alt="ELMOT Logo"
                                class="w-full h-full object-contain"
                            >

                        </div>

                        <div>

                            <h1 class="text-3xl font-black tracking-tight">
                                ELMOT RMS
                            </h1>

                            <p class="text-white/70 mt-1">
                                Record Management System
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Middle Text -->
                <div class="relative z-10 max-w-lg">

                    <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full text-sm mb-6 backdrop-blur-md">

                        <span class="w-2 h-2 bg-green-400 rounded-full"></span>

                        Smart Digital Workflow

                    </div>

                    <h2 class="text-5xl font-black leading-tight">

                        Manage Academic Records

                        <span class="text-sky-100">
                            Seamlessly
                        </span>

                    </h2>

                    <p class="mt-6 text-lg text-white/70 leading-relaxed">

                        Securely organize, track, and manage student and school records through a modern digital platform.

                    </p>

                </div>


                <!-- Bottom Stats -->
                <div class="relative z-10 grid grid-cols-3 gap-4">

                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-5">
                        <p class="text-white/60 text-sm">
                            Records
                        </p>

                        <h3 class="text-2xl font-black mt-2">
                            12K+
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-5">
                        <p class="text-white/60 text-sm">
                            Staff
                        </p>

                        <h3 class="text-2xl font-black mt-2">
                            84
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-5">
                        <p class="text-white/60 text-sm">
                            Secure
                        </p>

                        <h3 class="text-2xl font-black mt-2">
                            100%
                        </h3>
                    </div>

                </div>

            </div>


            <!-- Right Side -->
            <div class="bg-white/80 backdrop-blur-xl p-8 md:p-14 flex flex-col justify-center">

                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center gap-4 mb-10">

                    <div class="w-14 h-14 rounded-2xl bg-[#01a3e4] flex items-center justify-center p-2">

                        <img 
                            src="{{ asset('images/elmot-logo.png') }}"
                            alt="ELMOT Logo"
                            class="w-full h-full object-contain"
                        >

                    </div>

                    <div>
                        <h1 class="text-2xl font-black">
                            ELMOT RMS
                        </h1>

                        <p class="text-slate-500 text-sm">
                            School Management
                        </p>
                    </div>

                </div>


                <!-- Auth Content -->
                {{ $slot }}

            </div>

        </div>

    </div>


    <script>
        lucide.createIcons();
    </script>

</body>
</html>