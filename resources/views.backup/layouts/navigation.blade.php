<nav class="bg-white dark:bg-dark-card border-b-2 border-gray-900 dark:border-gray-700 sticky top-0 z-50" x-data="{ mobileMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 sm:h-20 items-center">

            <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 sm:gap-3">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-present-600 flex items-center justify-center rounded-[10px]">
                    <x-application-logo class="w-5 h-5 sm:w-6 sm:h-6 text-white" />
                </div>
                <span class="font-extrabold text-lg sm:text-xl text-gray-900 dark:text-white">Present</span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-6 text-sm">
                @if(Auth::user()->role === 'guru')
                    <a href="{{ route('guru.dashboard') }}" class="{{ request()->routeIs('guru.dashboard') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Dashboard</a>
                    <a href="{{ route('guru.attendances.index') }}" class="{{ request()->routeIs('guru.attendances*') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Absensi</a>
                    <a href="{{ route('guru.students.index') }}" class="{{ request()->routeIs('guru.students*') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Data Siswa</a>
                    <a href="{{ route('guru.classes.index') }}" class="{{ request()->routeIs('guru.classes*') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Kelas</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Kelola Akun</a>
                    <a href="{{ route('admin.classes.index') }}" class="{{ request()->routeIs('admin.classes*') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Kelas</a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" class="{{ request()->routeIs('siswa.dashboard') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Dashboard</a>
                    <a href="{{ route('siswa.absensi') }}" class="{{ request()->routeIs('siswa.absensi') ? 'text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400 font-medium' }}">Riwayat Absensi</a>
                @endif
            </div>

            <div class="flex items-center gap-2 sm:gap-4">
                <button @click="toggle()" class="icon-btn" aria-label="Toggle dark mode">
                    <!-- show sun by default, moon when dark; keep an always-visible fallback -->
                    <svg x-show="!dark" class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="dark" x-cloak class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                <div class="hidden sm:flex items-center gap-3">
                    <div class="avatar avatar-sm">
                        <span class="text-sm font-bold text-present-700 dark:text-present-300">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="text-sm">
                        <span class="text-gray-900 dark:text-white font-bold block text-xs sm:text-sm">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:block">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger text-xs sm:text-sm px-3 py-1.5 sm:px-4 sm:py-2">Logout</button>
                </form>

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
            <!-- Mobile User Info -->
            <div class="flex items-center gap-3 px-4 py-3 mb-3 bg-gray-50 dark:bg-gray-800 rounded-[10px]">
                <div class="w-10 h-10 bg-present-100 dark:bg-present-900/30 flex items-center justify-center border-2 border-present-600 dark:border-present-400 rounded-[10px]">
                    <span class="text-sm font-bold text-present-700 dark:text-present-300">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div class="text-sm">
                    <span class="text-gray-900 dark:text-white font-bold block">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>

            <nav class="flex flex-col gap-1">
                @if(Auth::user()->role === 'guru')
                    <a href="{{ route('guru.dashboard') }}" @click="mobileMenu = false" class="{{ request()->routeIs('guru.dashboard') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Dashboard</a>
                    <a href="{{ route('guru.attendances.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('guru.attendances*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Absensi</a>
                    <a href="{{ route('guru.students.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('guru.students*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Data Siswa</a>
                    <a href="{{ route('guru.classes.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('guru.classes*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Kelas</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" @click="mobileMenu = false" class="{{ request()->routeIs('admin.dashboard') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('admin.users*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Kelola Akun</a>
                    <a href="{{ route('admin.classes.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('admin.classes*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Kelas</a>
                    <a href="{{ route('admin.academic-years.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('admin.academic-years*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Tahun Ajaran</a>
                    <a href="{{ route('admin.attendances.index') }}" @click="mobileMenu = false" class="{{ request()->routeIs('admin.attendances*') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Laporan Absensi</a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" @click="mobileMenu = false" class="{{ request()->routeIs('siswa.dashboard') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Dashboard</a>
                    <a href="{{ route('siswa.absensi') }}" @click="mobileMenu = false" class="{{ request()->routeIs('siswa.absensi') ? 'bg-present-50 dark:bg-present-900/20 text-present-600 dark:text-present-400 font-bold' : 'text-gray-600 dark:text-gray-400 font-medium' }} px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Riwayat Absensi</a>
                @endif
            </nav>
        </div>

    </div>
</nav>
