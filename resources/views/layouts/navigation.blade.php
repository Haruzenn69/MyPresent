@php
$user = Auth::user();
$role = $user->role;
@endphp

<!-- Fixed Top Navbar -->
<header class="navbar navbar-expand-md fixed-top d-md-none" style="background: var(--surface); border-bottom: 1px solid var(--border); box-shadow: 0 2px 4px rgba(0,0,0,0.08);">
    <div class="container-fluid">
        <button class="navbar-toggler border-0 me-2 d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navDrawer" aria-controls="navDrawer" style="color: var(--md-sys-color-primary);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" width="24" height="24">
                <path d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
        </button>

        <a href="{{ url('/dashboard') }}" class="navbar-brand d-flex align-items-center gap-2 fw-semibold" style="color: var(--primary);">
            <x-application-logo style="width: 22px; height: 22px;" />
            Present
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @if($role === 'guru')
                    <li class="nav-item">
                        <a href="{{ route('guru.dashboard') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.attendances.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('guru.attendances*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.students.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('guru.students*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Data Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.classes.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('guru.classes*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru.qr-attendances.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('guru.qr-attendances*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            QR Absensi
                        </a>
                    </li>
                @elseif($role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Kelola Akun
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.users.index') }}" class="dropdown-item d-flex align-items-center gap-2 {{ !request('role') && request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                Semua Akun
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="{{ route('admin.users.index', ['role' => 'guru']) }}" class="dropdown-item d-flex align-items-center gap-2 {{ request('role') === 'guru' ? 'active' : '' }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                Guru
                            </a></li>
                            <li><a href="{{ route('admin.users.index', ['role' => 'siswa']) }}" class="dropdown-item d-flex align-items-center gap-2 {{ request('role') === 'siswa' ? 'active' : '' }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                Siswa
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.classes.index') }}" class="dropdown-item d-flex align-items-center gap-2">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="flex-shrink:0;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                Kelas
                            </a></li>
                             <li><a href="{{ route('admin.subjects.index') }}" class="dropdown-item d-flex align-items-center gap-2">
                                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="flex-shrink:0;"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                 Mata Pelajaran
                             </a></li>
                             <li><a href="{{ route('admin.academic-years.index') }}" class="dropdown-item d-flex align-items-center gap-2">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="flex-shrink:0;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                Tahun Ajaran
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.attendances.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.attendances*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            Pengaturan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.audit-logs.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.audit-logs*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0 1 9-9"/></svg>
                            Log
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.feedback.index') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.feedback*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
                            Feedback
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('siswa.dashboard') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.absensi') }}" class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('siswa.absensi') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            Absensi
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-flex align-items-center gap-2 ms-auto">
            <button @click="dark = !dark" class="btn btn-sm border-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; color: var(--text-secondary); background: var(--neutral-light);" x-cloak>
                <svg x-show="!dark" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg x-show="dark" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            </button>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:28px;height:28px;background:var(--primary-light);color:var(--primary);font-size:0.75rem;font-weight:600;">{{ substr($user->name, 0, 1) }}</span>
                    <span class="d-none d-md-inline">{{ $user->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('feedback.create') }}">Kirim Masukan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Offcanvas Drawer -->
<aside class="offcanvas offcanvas-start" tabindex="-1" id="navDrawer" aria-labelledby="navDrawerLabel">
    <div class="offcanvas-header border-bottom position-relative overflow-hidden">
        <div class="position-absolute top-0 end-0" style="width:120px;height:120px;background:radial-gradient(circle,rgba(13,148,136,0.08) 0%,transparent 70%);pointer-events:none;"></div>
        <div class="position-absolute bottom-0 start-0" style="width:80px;height:80px;background:radial-gradient(circle,rgba(13,148,136,0.05) 0%,transparent 70%);pointer-events:none;"></div>
        <div class="d-flex align-items-center gap-2 position-relative" style="z-index:1;">
            <x-application-logo style="width: 28px; height: 28px;" />
            <span class="fw-bold fs-5" id="navDrawerLabel" style="color:var(--md-sys-color-primary);">Present</span>
        </div>
        <button type="button" class="btn-close d-md-none position-relative" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0 d-flex flex-column scrollbar-hide">
        <nav class="list-group list-group-flush">
            <div class="list-group-item d-flex align-items-center gap-2 py-2" style="border: none;color:var(--md-sys-color-on-surface-variant);font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;">
                <span style="width:16px;height:2px;border-radius:2px;background:var(--md-sys-color-primary);opacity:0.4;"></span>
                Menu
                <span style="flex:1;height:1px;background:var(--md-sys-color-outline-variant);"></span>
            </div>

            @if($role === 'guru')
                <a href="{{ route('guru.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('guru.attendances.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('guru.attendances*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    Absensi
                </a>
                <a href="{{ route('guru.students.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('guru.students*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Data Siswa
                </a>
                <a href="{{ route('guru.classes.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('guru.classes*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    Kelas
                </a>
                <a href="{{ route('guru.qr-attendances.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('guru.qr-attendances*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    QR Absensi
                </a>
                <a href="{{ route('feedback.create') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('feedback*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
                    Kirim Masukan
                </a>

            @elseif($role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Dashboard
                </a>

                <button type="button" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 border-0 text-start w-100" data-bs-toggle="collapse" data-bs-target="#akunSubnav">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="flex-grow-1">Kelola Akun</span>
                    <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.2s;"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="collapse" id="akunSubnav">
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action ps-5 py-2 border-0 d-flex align-items-center gap-3 {{ !request('role') && request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Semua Akun
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'guru']) }}" class="list-group-item list-group-item-action ps-5 py-2 border-0 d-flex align-items-center gap-3 {{ request('role') === 'guru' ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        Guru
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'siswa']) }}" class="list-group-item list-group-item-action ps-5 py-2 border-0 d-flex align-items-center gap-3 {{ request('role') === 'siswa' ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Siswa
                    </a>
                </div>

                <button type="button" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 border-0 text-start w-100" data-bs-toggle="collapse" data-bs-target="#masterSubnav">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    <span class="flex-grow-1">Data Master</span>
                    <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transition: transform 0.2s;"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="collapse" id="masterSubnav">
                    <a href="{{ route('admin.classes.index') }}" class="list-group-item list-group-item-action ps-5 py-2 border-0 d-flex align-items-center gap-3 {{ request()->routeIs('admin.classes*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        Kelas
                    </a>
                     <a href="{{ route('admin.subjects.index') }}" class="list-group-item list-group-item-action ps-5 py-2 border-0 d-flex align-items-center gap-3 {{ request()->routeIs('admin.subjects*') ? 'active' : '' }}">
                         <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                         Mata Pelajaran
                     </a>
                     <a href="{{ route('admin.academic-years.index') }}" class="list-group-item list-group-item-action ps-5 py-2 border-0 d-flex align-items-center gap-3 {{ request()->routeIs('admin.academic-years*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="flex-shrink:0;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        Tahun Ajaran
                    </a>
                </div>

                <a href="{{ route('admin.attendances.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('admin.attendances*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    Absensi
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Laporan
                </a>
                <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    Pengaturan
                </a>
                <a href="{{ route('admin.audit-logs.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('admin.audit-logs*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0 1 9-9"/></svg>
                    Log
                </a>
                <a href="{{ route('admin.feedback.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('admin.feedback*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
                    Feedback
                </a>

            @else
                <a href="{{ route('siswa.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('siswa.absensi') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('siswa.absensi') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    Absensi
                </a>
                <a href="{{ route('feedback.create') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 {{ request()->routeIs('feedback*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" style="flex-shrink:0;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
                    Kirim Masukan
                </a>
            @endif
        </nav>

        <div class="border-top mt-auto p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:40px;height:40px;background:var(--md-primary-container);color:var(--md-on-primary-container);font-weight:600;">{{ substr($user->name, 0, 1) }}</div>
                    <div>
                        <div class="fw-medium">{{ $user->name }}</div>
                        <div class="text-muted small">{{ ucfirst($role) }}</div>
                    </div>
                </div>
                <button @click="dark = !dark" class="btn btn-sm border-0 rounded-circle d-flex align-items-center justify-content-center d-none d-md-flex" style="width:36px;height:36px;color:var(--text-secondary);background:var(--neutral-light);flex-shrink:0;" x-cloak>
                    <svg x-show="!dark" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    <svg x-show="dark" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>

<style>
.navbar .nav-link {
    color: var(--text-secondary);
}
.navbar .nav-link:hover {
    color: var(--text-primary);
}
.navbar .nav-link.active {
    font-weight: 600;
    position: relative;
    color: var(--text-primary);
}
.navbar .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: var(--bs-nav-link-padding-x, 0.5rem);
    right: var(--bs-nav-link-padding-x, 0.5rem);
    height: 2px;
    background: currentColor;
    border-radius: 1px;
}
.list-group-item.active {
    background: var(--md-primary-container);
    color: var(--md-on-primary-container);
    border-color: transparent;
    font-weight: 600;
}
.list-group-item.active svg {
    color: var(--md-primary);
}
.dark .list-group-item.active {
    background: var(--md-sys-color-primary-container);
    color: var(--md-sys-color-on-primary-container);
}
[data-bs-toggle="collapse"] .chevron {
    transition: transform 0.2s ease;
}
[data-bs-toggle="collapse"]:not(.collapsed) .chevron {
    transform: rotate(180deg);
}

/* Offcanvas 3/4 lebar layar */
.offcanvas.offcanvas-start {
    width: 75vw !important;
    max-width: 400px;
}
.offcanvas-backdrop {
    background: rgba(0,0,0,0.3) !important;
    backdrop-filter: blur(6px) !important;
    -webkit-backdrop-filter: blur(6px) !important;
}

.dark .offcanvas {
    background: var(--md-sys-color-surface-container) !important;
    color: var(--md-sys-color-on-surface);
}
.dark .offcanvas .list-group-item {
    background: transparent;
    color: var(--md-sys-color-on-surface);
    border-color: var(--md-sys-color-outline-variant);
}
.dark .offcanvas .list-group-item-action:hover {
    background: var(--md-sys-color-surface-container-high);
}
.dark .offcanvas-header {
    border-color: var(--md-sys-color-outline-variant) !important;
}
.dark .offcanvas .border-top {
    border-color: var(--md-sys-color-outline-variant) !important;
}
.dark .offcanvas .btn-close {
    filter: invert(1);
}

.dark .dropdown-menu {
    background: var(--md-sys-color-surface-container);
    border-color: var(--md-sys-color-outline-variant);
}
.dark .dropdown-item {
    color: var(--md-sys-color-on-surface);
}
.dark .dropdown-item:hover {
    background: var(--md-sys-color-surface-container-high);
    color: var(--md-sys-color-on-surface);
}
.dark .dropdown-divider {
    border-color: var(--md-sys-color-outline-variant);
}
.dark .navbar .nav-link.dropdown-toggle {
    color: var(--text-secondary);
}

/* Mobile: padding-top untuk fixed header */
@media (max-width: 767.98px) {
    #app-layout {
        padding-top: 64px !important;
    }
}

/* Desktop: sidebar permanen */
@media (min-width: 768px) {
    #app-layout {
        margin-left: 260px;
        padding-top: 0 !important;
    }
    .offcanvas.offcanvas-start {
        transform: none !important;
        visibility: visible !important;
        position: fixed;
        top: 0;
        left: 0;
        width: 260px !important;
        max-width: 260px !important;
        height: 100vh;
        z-index: 1030;
        border-right: 1px solid var(--border);
        overflow-y: auto;
    }
    .offcanvas-backdrop {
        display: none !important;
    }
    body {
        overflow-x: hidden;
    }
}
</style>
