<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-bold text-xl sm:text-2xl text-gray-900 dark:text-white">
                {{ __('Dashboard') }}
            </h2>
            <span class="badge badge-blue self-start">{{ ucfirst(Auth::user()->role) }}</span>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <!-- Welcome Card -->
            <div class="card p-6 sm:p-8 mb-6 sm:mb-8 bg-gradient-to-r from-present-600 to-present-700 text-white">
                <h3 class="text-xl sm:text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-present-100 text-sm sm:text-base">Kelola aktivitas Anda dari dashboard ini.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="avatar avatar-md bg-present-100 dark:bg-present-900/30">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-present-600 dark:text-present-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="badge badge-green text-xs">+12%</span>
                    </div>
                    <p class="stat-value text-2xl sm:text-3xl sm:text-4xl">1,234</p>
                    <p class="stat-label text-xs sm:text-sm">Total Siswa</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="avatar avatar-md bg-green-100 dark:bg-green-900/30">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="badge badge-green text-xs">+5%</span>
                    </div>
                    <p class="stat-value text-2xl sm:text-3xl sm:text-4xl">98%</p>
                    <p class="stat-label text-xs sm:text-sm">Hadir Hari Ini</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="avatar avatar-md bg-yellow-100 dark:bg-yellow-900/30">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="badge badge-yellow text-xs">+3%</span>
                    </div>
                    <p class="stat-value text-2xl sm:text-3xl sm:text-4xl">15</p>
                    <p class="stat-label text-xs sm:text-sm">Terlambat</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="avatar avatar-md bg-red-100 dark:bg-red-900/30">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m0 0l2-2m0 0l-2 2m0 0l-2 2m0 0l-2-2m7 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="badge badge-red text-xs">-2%</span>
                    </div>
                    <p class="stat-value text-2xl sm:text-3xl sm:text-4xl">8</p>
                    <p class="stat-label text-xs sm:text-sm">Tidak Hadir</p>
                </div>
            </div>

            <!-- Recent Activity -->
                <div class="card">
                <div class="card-header">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Aktivitas Terbaru</h3>
                </div>
                <div class="card-body p-4 sm:p-6">
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                            <div class="avatar avatar-sm bg-green-100 dark:bg-green-900/30 border-transparent flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm sm:text-base text-gray-900 dark:text-white truncate">Andi Saputra hadir</p>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Kelas 10A - 07:15 WIB</p>
                            </div>
                            <span class="badge badge-green text-xs flex-shrink-0">Hadir</span>
                        </div>

                        <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                            <div class="avatar avatar-sm bg-yellow-100 dark:bg-yellow-900/30 border-transparent flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm sm:text-base text-gray-900 dark:text-white truncate">Budi Wijaya terlambat</p>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Kelas 12C - 07:45 WIB</p>
                            </div>
                            <span class="badge badge-yellow text-xs flex-shrink-0">Terlambat</span>
                        </div>

                        <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                            <div class="avatar avatar-sm bg-blue-100 dark:bg-blue-900/30 border-transparent flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm sm:text-base text-gray-900 dark:text-white truncate">Siti Rahayu hadir</p>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Kelas 11B - 07:22 WIB</p>
                            </div>
                            <span class="badge badge-green text-xs flex-shrink-0">Hadir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
