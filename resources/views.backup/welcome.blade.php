<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ mobileMenu: false, ...theme }" x-init="init()" :class="{ 'dark': dark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Present') }} - Sistem Absensi Digital</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-dark-bg border-b-2 border-gray-900 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 sm:h-20">
                    <a href="/" class="flex items-center gap-2 sm:gap-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-present-600 flex items-center justify-center rounded-[10px]">
                            <x-application-logo class="w-5 h-5 sm:w-6 sm:h-6 text-white" />
                        </div>
                        <span class="font-extrabold text-xl sm:text-2xl text-gray-900 dark:text-white">Present</span>
                    </a>

                    <!-- Desktop Nav -->
                    <nav class="hidden md:flex items-center gap-8">
                        <a href="#features" class="font-medium text-gray-700 dark:text-gray-300 hover:text-present-600 dark:hover:text-present-400 transition-colors">Fitur</a>
                        <a href="#services" class="font-medium text-gray-700 dark:text-gray-300 hover:text-present-600 dark:hover:text-present-400 transition-colors">Layanan</a>
                        <a href="#stats" class="font-medium text-gray-700 dark:text-gray-300 hover:text-present-600 dark:hover:text-present-400 transition-colors">Statistik</a>
                        <a href="#testimonials" class="font-medium text-gray-700 dark:text-gray-300 hover:text-present-600 dark:hover:text-present-400 transition-colors">Testimoni</a>
                    </nav>

                    <div class="flex items-center gap-2">
                        <button @click="toggle()" class="icon-btn" aria-label="Toggle dark mode">
                            <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <svg x-show="dark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>

                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary text-sm px-3 py-2">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary text-sm px-3 py-2">
                                Log in
                            </a>
                        @endauth

                        <!-- Mobile Menu Toggle -->
                        <button @click="mobileMenu = !mobileMenu" class="md:hidden icon-btn" aria-label="Toggle menu">
                            <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="mobileMenu" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden pb-4 border-t-2 border-gray-900 dark:border-gray-700 pt-4">
                    <nav class="flex flex-col gap-2">
                        <a href="#features" @click="mobileMenu = false" class="px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 font-medium transition-colors rounded-[8px]">Fitur</a>
                        <a href="#services" @click="mobileMenu = false" class="px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 font-medium transition-colors rounded-[8px]">Layanan</a>
                        <a href="#stats" @click="mobileMenu = false" class="px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 font-medium transition-colors rounded-[8px]">Statistik</a>
                        <a href="#testimonials" @click="mobileMenu = false" class="px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 font-medium transition-colors rounded-[8px]">Testimoni</a>
                        @auth
                            <a href="{{ url('/dashboard') }}" @click="mobileMenu = false" class="btn btn-primary w-full justify-center mt-2">Dashboard</a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <main class="pt-16 sm:pt-20">
            <!-- Hero Section -->
            <section class="relative overflow-hidden bg-white dark:bg-dark-bg dotted-grid">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32">
                    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                        <div class="animate-slide-up">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full border-2 border-present-600 dark:border-present-400 bg-present-50 dark:bg-present-900/20 mb-4 sm:mb-6">
                                <span class="w-2 h-2 rounded-full bg-present-600 dark:bg-present-400 animate-pulse"></span>
                                <span class="text-xs sm:text-sm font-bold text-present-700 dark:text-present-300">Sistem Absensi #1 Indonesia</span>
                            </div>

                            <h1 class="display-title mb-4 sm:mb-6">
                                Kelola <span class="text-present-600 dark:text-present-400">Absensi</span>
                                <span class="text-stroke text-present-600/20">infrastruktur</span>
                            </h1>

                            <p class="text-base sm:text-lg lg:text-xl text-gray-600 dark:text-gray-400 mb-6 sm:mb-8 max-w-lg">
                                Platform digital untuk mencatat, memantau, dan melaporkan kehadiran siswa dan guru secara real-time.
                            </p>

                             <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary px-6 sm:px-8 py-3 sm:py-4 text-sm sm:text-base w-full sm:w-auto justify-center">
                                        Buka Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary px-6 sm:px-8 py-3 sm:py-4 text-sm sm:text-base w-full sm:w-auto justify-center">
                                        Log in
                                    </a>
                                @endauth
                            </div>

                            <div class="flex items-center gap-3 sm:gap-4 mt-6 sm:mt-8">
                                <div class="flex -space-x-3">
                                    <div class="avatar avatar-sm bg-present-200 dark:bg-present-800 border-white dark:border-dark-bg">
                                        <span class="text-xs font-bold text-present-700 dark:text-present-300">A</span>
                                    </div>
                                    <div class="avatar avatar-sm bg-green-200 dark:bg-green-800 border-white dark:border-dark-bg">
                                        <span class="text-xs font-bold text-green-700 dark:text-green-300">B</span>
                                    </div>
                                    <div class="avatar avatar-sm bg-yellow-200 dark:bg-yellow-800 border-white dark:border-dark-bg">
                                        <span class="text-xs font-bold text-yellow-700 dark:text-yellow-300">C</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    </div>
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">500+ sekolah sudah bergabung</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hero Image - Visible on medium screens and up -->
                        <div class="relative animate-fade-in hidden lg:block">
                            <div class="relative w-full aspect-square max-w-lg mx-auto">
                                <div class="absolute inset-0 bg-gradient-to-br from-present-100 to-present-200 dark:from-present-900/30 dark:to-present-800/20 rounded-[14px] transform rotate-6"></div>
                                <div class="absolute inset-0 card p-6 sm:p-8">
                                    <div class="h-full flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between mb-4 sm:mb-6">
                                                <div class="flex items-center gap-2 sm:gap-3">
                                                    <div class="avatar avatar-sm">
                                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-present-600 dark:text-present-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white">Hari Ini</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">Senin, 5 Mei 2026</p>
                                                    </div>
                                                </div>
                                                <span class="badge badge-green text-xs">Live</span>
                                            </div>
                                            <div class="space-y-2 sm:space-y-3">
                                                <div class="flex items-center justify-between p-2 sm:p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                                                    <div class="flex items-center gap-2 sm:gap-3">
                                                        <div class="avatar avatar-sm rounded-full bg-green-100 dark:bg-green-900/30 border-transparent">
                                                            <span class="text-xs font-bold text-green-700 dark:text-green-300">AS</span>
                                                        </div>
                                                        <div>
                                                            <p class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white">Andi Saputra</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">Kelas 10A</p>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs font-bold text-green-600 dark:text-green-400">07:15</span>
                                                </div>
                                                <div class="flex items-center justify-between p-2 sm:p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                                                    <div class="flex items-center gap-2 sm:gap-3">
                                                        <div class="avatar avatar-sm rounded-full bg-blue-100 dark:bg-blue-900/30 border-transparent">
                                                            <span class="text-xs font-bold text-blue-700 dark:text-blue-300">SR</span>
                                                        </div>
                                                        <div>
                                                            <p class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white">Siti Rahayu</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">Kelas 11B</p>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs font-bold text-green-600 dark:text-green-400">07:22</span>
                                                </div>
                                                <div class="flex items-center justify-between p-2 sm:p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                                                    <div class="flex items-center gap-2 sm:gap-3">
                                                        <div class="avatar avatar-sm rounded-full bg-yellow-100 dark:bg-yellow-900/30 border-transparent">
                                                            <span class="text-xs font-bold text-yellow-700 dark:text-yellow-300">BW</span>
                                                        </div>
                                                        <div>
                                                            <p class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white">Budi Wijaya</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">Kelas 12C</p>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs font-bold text-yellow-600 dark:text-yellow-400">07:45</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-2 sm:gap-3 mt-4 sm:mt-6">
                                            <div class="text-center p-2 sm:p-3 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                                                <p class="text-lg sm:text-xl font-bold text-green-600 dark:text-green-400">85%</p>
                                                <p class="text-xs text-green-700 dark:text-green-300">Hadir</p>
                                            </div>
                                            <div class="text-center p-2 sm:p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                                                <p class="text-lg sm:text-xl font-bold text-yellow-600 dark:text-yellow-400">10%</p>
                                                <p class="text-xs text-yellow-700 dark:text-yellow-300">Terlambat</p>
                                            </div>
                                            <div class="text-center p-2 sm:p-3 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
                                                <p class="text-lg sm:text-xl font-bold text-red-600 dark:text-red-400">5%</p>
                                                <p class="text-xs text-red-700 dark:text-red-300">Tidak Hadir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Claim username input (visual only) -->
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
                    <div class="flex gap-3 items-center">
                        <div class="flex-1 flex items-center bg-white dark:bg-dark-card rounded-[14px] border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-4 py-3 text-sm text-gray-500">cal.com/</div>
                            <input type="text" placeholder="RickAstley" class="input flex-1 border-l border-gray-200 dark:border-gray-700 bg-transparent p-3" />
                        </div>
                        <button class="btn-outline">Claim Username</button>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="py-16 sm:py-24 lg:py-32 bg-gray-50 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                        <span class="badge badge-blue mb-4">Fitur Unggulan</span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mt-4 mb-4 sm:mb-6">
                            Semua yang Anda <span class="text-present-600 dark:text-present-400">Butuhkan</span>
                        </h2>
                        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">
                            Platform lengkap untuk mengelola absensi dengan efisien dan akurat.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-present-100 dark:bg-present-900/30 flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-present-600 dark:text-present-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Real-time Tracking</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Catat kehadiran secara langsung dan pantau status kehadiran secara real-time dari mana saja.</p>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Laporan Detail</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Generate laporan absensi lengkap dengan grafik dan statistik yang mudah dipahami.</p>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Keamanan Data</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Data tersimpan dengan enkripsi dan dapat diakses kapan saja dengan aman.</p>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Notifikasi Otomatis</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kirim notifikasi ke orang tua saat siswa absen atau terlambat secara otomatis.</p>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Multi Role</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Akses berbeda untuk admin, guru, dan siswa dengan hak akses yang terstruktur.</p>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center mb-4 sm:mb-6">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Mobile Friendly</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Akses dari perangkat apapun dengan tampilan yang responsif dan optimal.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section id="services" class="py-16 sm:py-24 lg:py-32 bg-white dark:bg-dark-bg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                        <div class="order-2 lg:order-1">
                            <span class="badge badge-blue mb-4">Layanan Kami</span>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mt-4 mb-4 sm:mb-6">
                                Solusi Lengkap untuk <span class="text-present-600 dark:text-present-400">Sekolah</span>
                            </h2>
                            <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 mb-6 sm:mb-8">
                                Kami menyediakan berbagai layanan untuk membantu sekolah mengelola absensi dengan lebih efisien.
                            </p>

                            <div class="space-y-4 sm:space-y-6">
                                <div class="flex gap-3 sm:gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-present-100 dark:bg-present-900/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-present-600 dark:text-present-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-1">Manajemen Siswa</h4>
                                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kelola data siswa, kelas, dan jadwal dengan mudah dalam satu platform.</p>
                                    </div>
                                </div>

                                <div class="flex gap-3 sm:gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-1">Laporan & Analitik</h4>
                                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Dapatkan insight mendalam dengan laporan yang detail dan visualisasi data.</p>
                                    </div>
                                </div>

                                <div class="flex gap-3 sm:gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-1">Integrasi Mudah</h4>
                                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Terhubung dengan sistem lain yang sudah digunakan sekolah Anda.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative order-1 lg:order-2">
                            <div class="card p-6 sm:p-8">
                                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3 sm:p-4 border border-gray-200 dark:border-gray-700">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-present-100 dark:bg-present-900/30 flex items-center justify-center mb-2 sm:mb-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-present-600 dark:text-present-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">1,200+</p>
                                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Siswa Terdaftar</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3 sm:p-4 border border-gray-200 dark:border-gray-700">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-2 sm:mb-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">98%</p>
                                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Akurasi Data</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3 sm:p-4 border border-gray-200 dark:border-gray-700">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center mb-2 sm:mb-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">24/7</p>
                                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Akses Online</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3 sm:p-4 border border-gray-200 dark:border-gray-700">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center mb-2 sm:mb-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                        </div>
                                        <p class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Instant</p>
                                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Notifikasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section id="stats" class="py-16 sm:py-24 lg:py-32 bg-gray-900 dark:bg-black text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12 sm:mb-16">
                        <span class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full border-2 border-present-400 bg-present-900/20 mb-4">
                            <span class="text-xs sm:text-sm font-bold text-present-300">Statistik</span>
                        </span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold mt-4 mb-4 sm:mb-6">
                            Dipercaya oleh <span class="text-present-400">Ratusan</span> Sekolah
                        </h2>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                        <div class="text-center">
                            <p class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-present-400 mb-2">500+</p>
                            <p class="text-sm sm:text-lg text-gray-400 font-medium">Sekolah</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-green-400 mb-2">50K+</p>
                            <p class="text-sm sm:text-lg text-gray-400 font-medium">Siswa</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-yellow-400 mb-2">5M+</p>
                            <p class="text-sm sm:text-lg text-gray-400 font-medium">Absensi</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-red-400 mb-2">99%</p>
                            <p class="text-sm sm:text-lg text-gray-400 font-medium">Uptime</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section id="testimonials" class="py-16 sm:py-24 lg:py-32 bg-white dark:bg-dark-bg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                        <span class="badge badge-blue mb-4">Testimoni</span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mt-4 mb-4 sm:mb-6">
                            Apa Kata <span class="text-present-600 dark:text-present-400">Mereka</span>
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="flex items-center gap-1 mb-4">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-6">"Present sangat membantu kami dalam mengelola absensi. Laporan yang dihasilkan sangat detail dan mudah dipahami."</p>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar-md bg-present-100 dark:bg-present-900/30 border-transparent">
                                    <span class="text-sm font-bold text-present-700 dark:text-present-300">DR</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white">Dewi Rahayu</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Kepala Sekolah</p>
                                </div>
                            </div>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover">
                            <div class="flex items-center gap-1 mb-4">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-6">"Sebagai guru, saya sangat terbantu dengan fitur absensi digital ini. Proses pencatatan menjadi lebih cepat dan efisien."</p>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar-md bg-green-100 dark:bg-green-900/30 border-transparent">
                                    <span class="text-sm font-bold text-green-700 dark:text-green-300">AS</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white">Ahmad Surya</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Guru Matematika</p>
                                </div>
                            </div>
                        </div>

                        <div class="card p-6 sm:p-8 card-hover sm:col-span-2 lg:col-span-1">
                            <div class="flex items-center gap-1 mb-4">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-6">"Orang tua saya senang karena bisa langsung tahu kalau saya hadir di sekolah. Sistemnya sangat membantu!"</p>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar-md bg-yellow-100 dark:bg-yellow-900/30 border-transparent">
                                    <span class="text-sm font-bold text-yellow-700 dark:text-yellow-300">FN</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white">Fajar Nugroho</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Siswa Kelas 11</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-16 sm:py-24 lg:py-32 bg-present-600">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-4 sm:mb-6">
                        Siap Memulai?
                    </h2>
                    <p class="text-base sm:text-xl text-present-100 mb-6 sm:mb-8 max-w-2xl mx-auto">
                        Bergabung dengan ratusan sekolah yang sudah menggunakan Present untuk mengelola absensi mereka.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn bg-white text-present-600 border-white hover:bg-gray-50 hover:shadow-lg px-6 sm:px-8 py-3 sm:py-4 text-sm sm:text-base w-full sm:w-auto justify-center">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn bg-white text-present-600 border-white hover:bg-gray-50 hover:shadow-lg px-6 sm:px-8 py-3 sm:py-4 text-sm sm:text-base w-full sm:w-auto justify-center">
                                Log in
                            </a>
                        @endauth
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 dark:bg-black text-white border-t-2 border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8 sm:mb-12">
                    <div class="col-span-2 md:col-span-1">
                        <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-present-600 flex items-center justify-center">
                                <x-application-logo class="w-5 h-5 sm:w-6 sm:h-6 text-white" />
                            </div>
                            <span class="font-extrabold text-lg sm:text-xl">Present</span>
                        </div>
                        <p class="text-gray-400 text-xs sm:text-sm">Sistem absensi digital untuk sekolah modern Indonesia.</p>
                    </div>

                    <div>
                        <h4 class="font-bold text-white mb-3 sm:mb-4 text-sm sm:text-base">Produk</h4>
                        <ul class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-gray-400">
                            <li><a href="#features" class="hover:text-present-400 transition-colors">Fitur</a></li>
                            <li><a href="#services" class="hover:text-present-400 transition-colors">Layanan</a></li>
                            <li><a href="#stats" class="hover:text-present-400 transition-colors">Statistik</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-white mb-3 sm:mb-4 text-sm sm:text-base">Perusahaan</h4>
                        <ul class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-gray-400">
                            <li><a href="#" class="hover:text-present-400 transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-present-400 transition-colors">Kontak</a></li>
                            <li><a href="#" class="hover:text-present-400 transition-colors">Karir</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-white mb-3 sm:mb-4 text-sm sm:text-base">Legal</h4>
                        <ul class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-gray-400">
                            <li><a href="#" class="hover:text-present-400 transition-colors">Privasi</a></li>
                            <li><a href="#" class="hover:text-present-400 transition-colors">Ketentuan</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-6 sm:pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs sm:text-sm text-gray-400">Present &copy; {{ date('Y') }}. All rights reserved.</p>
                    <div class="flex items-center gap-3 sm:gap-4">
                        <a href="#" class="text-gray-400 hover:text-present-400 transition-colors">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-present-400 transition-colors">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-present-400 transition-colors">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
