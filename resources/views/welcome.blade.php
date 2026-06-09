<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }" x-init="() => { if (dark) document.documentElement.classList.add('dark'); $watch('dark', val => { if (val) { document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); } else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); } }) }" :class="{ 'dark': dark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Present') }} - Sistem Absensi Digital</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --md-primary: #0D9488;
            --md-on-primary: #FFFFFF;
            --md-primary-container: #EADDFF;
            --md-on-primary-container: #21005D;
            --md-secondary: #625B71;
            --md-secondary-container: #E8DEF8;
            --md-surface: #FFFBFE;
            --md-surface-variant: #E7E0EC;
            --md-on-surface: #1C1B1F;
            --md-on-surface-variant: #49454F;
            --md-outline: #79747E;
            --md-error: #B3261E;
            --md-radius-xs: 4px;
            --md-radius-sm: 8px;
            --md-radius-md: 12px;
            --md-radius-lg: 16px;
            --md-radius-xl: 28px;
            --md-radius-full: 50px;
            --md-elevation-1: 0 1px 2px rgba(0,0,0,0.3), 0 1px 3px 1px rgba(0,0,0,0.15);
            --md-elevation-2: 0 1px 2px rgba(0,0,0,0.3), 0 2px 6px 2px rgba(0,0,0,0.15);
            --md-elevation-3: 0 4px 8px 3px rgba(0,0,0,0.15), 0 1px 3px rgba(0,0,0,0.3);
        }
    </style>
    <style>
        :root {
            --avatar-1-bg: var(--md-sys-color-primary-container);
            --avatar-1-fg: var(--md-sys-color-primary);
            --avatar-1-glow: rgba(13,148,136,0.25);
            --avatar-2-bg: var(--md-sys-color-secondary-container);
            --avatar-2-fg: var(--md-sys-color-secondary);
            --avatar-2-glow: rgba(8,145,178,0.25);
            --avatar-3-bg: #f3e8ff;
            --avatar-3-fg: #7c3aed;
            --avatar-3-glow: rgba(124,58,237,0.25);
            --avatar-4-bg: var(--md-sys-color-error-container);
            --avatar-4-fg: var(--md-sys-color-error);
            --avatar-4-glow: rgba(239,68,68,0.25);
            --avatar-5-bg: #dbeafe;
            --avatar-5-fg: #2563eb;
            --avatar-5-glow: rgba(37,99,235,0.25);
            --avatar-6-bg: #fce7f3;
            --avatar-6-fg: #db2777;
            --avatar-6-glow: rgba(219,39,119,0.25);
        }
        .dark {
            --avatar-3-bg: #3b1f6e;
            --avatar-3-fg: #c084fc;
            --avatar-5-bg: #1e3a5f;
            --avatar-5-fg: #93c5fd;
            --avatar-6-bg: #4a1147;
            --avatar-6-fg: #f9a8d4;
        }
        .footer-link:hover { color: rgba(255,255,255,0.9) !important; }
        #main-footer a.rounded-circle:hover { background: rgba(255,255,255,0.15) !important; color: #fff !important; }
    </style>
    <style>
        .btn-tonal {
            background-color: var(--md-secondary-container);
            color: var(--md-on-primary-container);
            border-radius: var(--md-radius-full);
            padding: 10px 24px;
            font-weight: 500;
            font-size: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            line-height: 1;
            gap: 6px;
        }
    </style>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-24px); }
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-16px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 4px 24px rgba(13,148,136,0.3); }
            50% { box-shadow: 0 8px 40px rgba(13,148,136,0.5), 0 0 80px rgba(13,148,136,0.12); }
        }
        @keyframes blob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .hero-gradient {
            background: linear-gradient(165deg,
                var(--md-sys-color-surface) 0%,
                var(--md-sys-color-primary-container) 25%,
                var(--md-sys-color-primary-container) 45%,
                var(--md-sys-color-surface) 80%,
                var(--md-sys-color-surface) 100%
            );
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: blob 12s ease-in-out infinite;
        }
        .hero-blob-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(13,148,136,0.08) 0%, transparent 70%);
            top: -200px; right: -100px;
            animation-delay: 0s;
        }
        .hero-blob-2 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(8,145,178,0.06) 0%, transparent 70%);
            bottom: -120px; left: -80px;
            animation-delay: -4s;
        }
        .hero-blob-3 {
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(6,182,212,0.06) 0%, transparent 70%);
            top: 30%; left: 55%;
            animation-delay: -8s;
        }

        .preview-card {
            background: var(--md-sys-color-surface-container-low);
            border: 1px solid var(--md-sys-color-outline-variant);
            box-shadow: 0 8px 40px rgba(0,0,0,0.04), 0 2px 12px rgba(0,0,0,0.03);
            animation: fadeUp 0.8s ease-out;
        }

        .preview-card-glow {
            position: absolute;
            top: 6%; left: 6%; right: -6%; bottom: -6%;
            transform: rotate(3deg);
            background: linear-gradient(135deg, rgba(13,148,136,0.06), rgba(8,145,178,0.04));
            border: 1px solid rgba(13,148,136,0.06);
            border-radius: 24px;
        }

        .badge-accent {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: 100px;
            background: rgba(13,148,136,0.06);
            border: 1px solid rgba(13,148,136,0.12);
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--md-sys-color-primary);
            letter-spacing: 0.01em;
        }
        .badge-accent .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--md-sys-color-primary);
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .section-gradient-top {
            height: 3rem;
            background: linear-gradient(to bottom, transparent 0%, var(--md-sys-color-surface-container) 100%);
        }
        .section-gradient-bottom {
            height: 3rem;
            background: linear-gradient(to top, transparent 0%, var(--md-sys-color-surface-container) 100%);
        }
        .section-gradient-top-suf {
            height: 3rem;
            background: linear-gradient(to bottom, transparent 0%, var(--md-sys-color-surface) 100%);
        }

        .testimonial-card .quote-mark {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 5rem;
            line-height: 1;
            color: var(--md-sys-color-primary);
            opacity: 0.06;
            font-family: Georgia, serif;
            pointer-events: none;
        }

        .cta-gradient {
            background: linear-gradient(160deg, var(--md-sys-color-primary) 0%, #0D9488 35%, #0891B2 65%, #0F766E 100%);
            position: relative;
            overflow: hidden;
        }
        .cta-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 15% 60%, rgba(255,255,255,0.1) 0%, transparent 60%),
                radial-gradient(ellipse 500px 300px at 85% 40%, rgba(167,139,250,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 400px 400px at 50% 100%, rgba(255,255,255,0.04) 0%, transparent 60%);
            pointer-events: none;
        }
        .btn-glow {
            box-shadow: 0 0 24px rgba(13,148,136,0.35);
        }
        .btn-white-ghost {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(4px);
            height: 56px;
            padding: 0 36px;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: var(--md-sys-shape-corner-full);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-white-ghost:hover {
            background: rgba(255,255,255,0.18);
            border-color: rgba(255,255,255,0.4);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        @media (max-width: 767.98px) {
            .btn-white-ghost {
                height: 48px;
                padding: 0 24px;
                font-size: 0.9rem;
            }
        }

        /* Remove ALL tap effects on mobile */
        *, *::before, *::after {
            -webkit-tap-highlight-color: transparent !important;
            -webkit-touch-callout: none;
        }

        /* Remove btn state layer completely on landing page */
        .btn::after, .btn::before, a.btn::after, a.btn::before {
            display: none !important;
        }

        /* Smaller button text on landing page */
        .landing-btn {
            font-size: 0.875rem;
            padding: 10px 28px;
        }

        /* Remove all focus/active outlines */
        *:focus, *:active, *:focus-visible {
            outline: none !important;
        }

        /* Cards - no tap border */
        .feature-card-premium,
        .stat-card-premium, .service-item {
            -webkit-tap-highlight-color: transparent !important;
            outline: none !important;
            border-top: none !important;
        }

        /* Testimonial section must NOT clip overflow so shadows show */
        #testimonials {
            overflow: visible !important;
            overflow-x: clip !important;
        }



        html, body{
            overflow-x: hidden
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

    </style>
</head>
<body>

    {{-- Bootstrap Navbar --}}
    <nav class="navbar navbar-expand-lg fixed-top navbar-glass py-0" style="backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); background: rgba(255,255,255,0.85); height: 64px;">
        <div class="container">
            <div class="d-flex align-items-center">
                <button class="navbar-toggler border-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#navDrawer" aria-controls="navDrawer" style="color: var(--md-sys-color-primary);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" width="24" height="24">
                        <path d="M3 12h18M3 6h18M3 18h18"/>
                    </svg>
                </button>

                <a href="/" class="navbar-brand d-flex align-items-center gap-2">
                    <x-application-logo style="width: 32px; height: 32px;" />
                    <span style="font-weight: 800; font-size: 1.2rem; background: linear-gradient(135deg, var(--md-sys-color-primary), var(--md-sys-color-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Present</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item"><a href="#features" class="nav-link fw-medium d-inline-flex align-items-center gap-1" style="color: var(--md-sys-color-on-surface);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>Fitur</a></li>
                    <li class="nav-item"><a href="#services" class="nav-link fw-medium d-inline-flex align-items-center gap-1" style="color: var(--md-sys-color-on-surface);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>Layanan</a></li>
                    <li class="nav-item"><a href="#stats" class="nav-link fw-medium d-inline-flex align-items-center gap-1" style="color: var(--md-sys-color-on-surface);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>Statistik</a></li>
                    <li class="nav-item"><a href="#testimonials" class="nav-link fw-medium d-inline-flex align-items-center gap-1" style="color: var(--md-sys-color-on-surface);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Testimoni</a></li>
                </ul>
            </div>

            <div class="d-none d-lg-flex align-items-center gap-2">
                <button @click="dark = !dark" class="btn btn-outline-secondary border-0" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 50%;" :title="dark ? 'Mode Terang' : 'Mode Gelap'">
                    <template x-if="!dark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    </template>
                    <template x-if="dark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                    </template>
                </button>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary landing-btn">
                        Dashboard
                    </a>
                @else
                    <a href="#demo" class="btn btn-outline-secondary landing-btn">
                        Coba Demo
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-primary landing-btn">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Offcanvas Drawer --}}
    <aside class="offcanvas offcanvas-start" tabindex="-1" id="navDrawer" aria-labelledby="navDrawerLabel">
        <div class="offcanvas-header border-bottom">
            <div class="d-flex align-items-center gap-2">
                    <x-application-logo style="width: 36px; height: 36px;" />
                    <span class="fw-bold fs-5" id="navDrawerLabel">Present</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0 d-flex flex-column">
            <nav class="list-group list-group-flush">
                <a href="#features" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 border-0 nav-link-offcanvas">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="flex-shrink:0;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Fitur
                </a>
                <a href="#services" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 border-0 nav-link-offcanvas">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="flex-shrink:0;"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    Layanan
                </a>
                <a href="#stats" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 border-0 nav-link-offcanvas">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="flex-shrink:0;"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    Statistik
                </a>
                <a href="#testimonials" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 border-0 nav-link-offcanvas">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" style="flex-shrink:0;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Testimoni
                </a>
            </nav>
            <div class="border-top mt-auto p-3">
                <button @click="dark = !dark" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2 mb-2">
                    <template x-if="!dark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    </template>
                    <template x-if="dark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                    </template>
                    <span x-text="dark ? 'Mode Terang' : 'Mode Gelap'"></span>
                </button>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary w-100 landing-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 landing-btn">Masuk</a>
                @endauth
            </div>
        </div>
    </aside>

    <main style="padding-top: 64px;">

        {{-- Hero Section --}}
        <section class="position-relative overflow-hidden hero-gradient hero-section">
            <div class="hero-blob hero-blob-1"></div>
            <div class="hero-blob hero-blob-2"></div>
            <div class="hero-blob hero-blob-3"></div>

            <div class="container position-relative" style="z-index: 1;">
                <div class="row align-items-center g-4 g-lg-5" style="padding: 0.25rem">
                    <div class="col-lg-6">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-4 rounded-pill border" style="border-color: var(--md-sys-color-outline) !important; color: var(--md-sys-color-on-surface-variant); background: var(--md-sys-color-surface); font-size: 0.875rem">
                            <span class="dot">Sistem Absensi #1 Indonesia</span>
                        </div>

                        <h1 class="fw-bold mb-3" style="font-size: clamp(2.5rem, 6.5vw, 4.5rem); font-weight: 800; line-height: 1.1; letter-spacing: -0.035em; color: var(--md-sys-color-on-surface);">
                            <span style="text-shadow: 0 2px 4px rgba(0,0,0,0.06);">Kelola Absensi</span><br>
                            <span class="text-gradient" style="text-shadow: 0 2px 8px rgba(13,148,136,0.2);">Sekolah Modern</span>
                        </h1>

                        <p class="mb-4" style="font-size: clamp(1rem, 2vw, 1.15rem); line-height: 1.7; color: var(--md-sys-color-on-surface-variant);">
                            Platform digital untuk mencatat, memantau, dan melaporkan kehadiran siswa &amp; guru secara real-time. Efisien, akurat, dan terpercaya.
                        </p>

                        <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-glow landing-btn">
                                    <i class="bi bi-speedometer2 me-2"></i> Buka Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-premium btn-glow landing-btn">
                                    <i class="bi bi-arrow-right me-2"></i> Mulai Sekarang
                                </a>
                                <a href="#features" class="btn btn-secondary btn-premium landing-btn">
                                    <i class="bi bi-play-circle me-2"></i> Coba Demo
                                </a>
                            @endauth
                        </div>

                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="d-flex avatar-stack" style="margin: 0;">
                                <div class="avatar-a rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #ECFDF5; border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.25s ease; cursor: default;">
                                    <span class="small fw-bold" style="color: #065F46;">A</span>
                                </div>
                                <div class="avatar-b rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; margin-left: -12px; background: #EEF2FF; border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.25s ease; cursor: default;">
                                    <span class="small fw-bold" style="color: #312E81;">B</span>
                                </div>
                                <div class="avatar-c rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; margin-left: -12px; background: #FFF7ED; border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.25s ease; cursor: default;">
                                    <span class="small fw-bold" style="color: #9A3412;">C</span>
                                </div>
                                <div class="avatar-d rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; margin-left: -12px; background: #F3E8FF; border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.25s ease; cursor: default;">
                                    <span class="small fw-bold" style="color: #5B21B6;">D</span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1 mb-1" style="color: #F59E0B;">
                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                </div>
                                <p class="small mb-0" style="color: var(--md-sys-color-on-surface-variant); font-weight: 500;">Dipercaya <strong style="color: var(--md-sys-color-on-surface);">500+ sekolah</strong> di Indonesia</p>
                            </div>
                        </div>
                    </div>

                    {{-- Hero Preview Card --}}
                    <div class="col-lg-6">
                        <div class="position-relative">
                             <div class="preview-card overflow-hidden" style="border-radius:24px;">
                                  <div class="d-flex align-items-center" style="padding:0.5rem 0.75rem;background:var(--md-sys-color-surface-container);border-bottom:2px solid var(--md-sys-color-outline-variant);border-radius:24px 24px 0 0;">
                                    <div class="d-flex align-items-center gap-3 ms-1">
                                        <div class="d-flex" style="gap: 0.375rem;">
                                            <span class="rounded-circle" style="width: 8px; height: 8px; background: #EF4444;"></span>
                                            <span class="rounded-circle" style="width: 8px; height: 8px; background: #F59E0B;"></span>
                                            <span class="rounded-circle" style="width: 8px; height: 8px; background: #10B981;"></span>
                                        </div>
                                        <span class="fw-medium" style="color: var(--md-sys-color-on-surface-variant);font-size:12px;">Kehadiran Hari Ini</span>
                                        <span id="live-time" style="font-size:11px;color:var(--md-sys-color-on-surface-variant);opacity:0.7;margin-left:auto;"></span>
                                    </div>
                                </div>
                                <div style="padding:12px;">
                                    <div id="attendance-list" class="row g-2">
                                        <div class="col-12">
                                            <div class="attendance-item d-flex align-items-center rounded-4" style="background:var(--md-sys-color-surface-container);border:1px solid var(--md-sys-color-outline-variant);--card-border:var(--avatar-1-fg);--card-glow:var(--avatar-1-glow);">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: var(--avatar-1-bg);">
                                                    <span class="fw-bold" style="color: var(--avatar-1-fg);">AS</span>
                                                </div>
                                                <div class="min-w-0 flex-grow-1">
                                                    <p class="fw-semibold mb-1 text-truncate" style="color:var(--md-sys-color-on-surface);line-height:1.3;">Andi Saputra</p>
                                                    <p class="mb-0 text-truncate" style="color:var(--md-sys-color-on-surface-variant);line-height:1.2;">Kelas 10A</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="attendance-item d-flex align-items-center rounded-4" style="background:var(--md-sys-color-surface-container);border:1px solid var(--md-sys-color-outline-variant);--card-border:var(--avatar-2-fg);--card-glow:var(--avatar-2-glow);">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: var(--avatar-2-bg);">
                                                    <span class="fw-bold" style="color: var(--avatar-2-fg);">SR</span>
                                                </div>
                                                <div class="min-w-0 flex-grow-1">
                                                    <p class="fw-semibold mb-1 text-truncate" style="color:var(--md-sys-color-on-surface);line-height:1.3;">Siti Rahayu</p>
                                                    <p class="mb-0 text-truncate" style="color:var(--md-sys-color-on-surface-variant);line-height:1.2;">Kelas 11B</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="attendance-item d-flex align-items-center rounded-4" style="background:var(--md-sys-color-surface-container);border:1px solid var(--md-sys-color-outline-variant);--card-border:var(--avatar-3-fg);--card-glow:var(--avatar-3-glow);">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: var(--avatar-3-bg);">
                                                    <span class="fw-bold" style="color: var(--avatar-3-fg);">BW</span>
                                                </div>
                                                <div class="min-w-0 flex-grow-1">
                                                    <p class="fw-semibold mb-1 text-truncate" style="color:var(--md-sys-color-on-surface);line-height:1.3;">Budi Wijaya</p>
                                                    <p class="mb-0 text-truncate" style="color:var(--md-sys-color-on-surface-variant);line-height:1.2;">Kelas 12C</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="attendance-item d-flex align-items-center rounded-4" style="background:var(--md-sys-color-surface-container);border:1px solid var(--md-sys-color-outline-variant);--card-border:var(--avatar-4-fg);--card-glow:var(--avatar-4-glow);">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: var(--avatar-4-bg);">
                                                    <span class="fw-bold" style="color: var(--avatar-4-fg);">DN</span>
                                                </div>
                                                <div class="min-w-0 flex-grow-1">
                                                    <p class="fw-semibold mb-1 text-truncate" style="color:var(--md-sys-color-on-surface);line-height:1.3;">Dian Nurhayati</p>
                                                    <p class="mb-0 text-truncate" style="color:var(--md-sys-color-on-surface-variant);line-height:1.2;">Kelas 10B</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="attendance-empty" class="text-center py-4 d-none">
                                        <p class="mb-0" style="font-size: 0.85rem; color: var(--md-sys-color-on-surface-variant);">Belum ada data hari ini</p>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3 px-2">
                                        <div class="stat-pill d-inline-flex align-items-center gap-1 rounded-pill" style="padding:4px 12px;font-size:12px;font-weight:600;background:var(--md-sys-color-primary-container);border:1px solid var(--md-sys-color-primary);--card-border:var(--md-sys-color-primary);--card-glow:rgba(13,148,136,0.2);">
                                            <span id="pct-hadir" style="color:var(--md-sys-color-primary);">--</span>
                                            <span style="color:var(--md-sys-color-primary);opacity:0.8;">Hadir</span>
                                        </div>
                                        <div class="stat-pill d-inline-flex align-items-center gap-1 rounded-pill" style="padding:4px 12px;font-size:12px;font-weight:600;background:var(--md-sys-color-secondary-container);border:1px solid var(--md-sys-color-secondary);--card-border:var(--md-sys-color-secondary);--card-glow:rgba(8,145,178,0.2);">
                                            <span id="pct-telat" style="color:var(--md-sys-color-secondary);">--</span>
                                            <span style="color:var(--md-sys-color-secondary);opacity:0.8;">Telat</span>
                                        </div>
                                        <div class="stat-pill d-inline-flex align-items-center gap-1 rounded-pill" style="padding:4px 12px;font-size:12px;font-weight:600;background:var(--md-sys-color-error-container);border:1px solid var(--md-sys-color-error);--card-border:var(--md-sys-color-error);--card-glow:rgba(239,68,68,0.2);">
                                            <span id="pct-alfa" style="color:var(--md-sys-color-error);">--</span>
                                            <span style="color:var(--md-sys-color-error);opacity:0.8;">Alpha</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Features Section --}}
        <section id="features" class="section-premium position-relative" style="background: var(--md-sys-color-surface-container); overflow-x: clip;">
            <div class="container position-relative" style="max-width: 1200px; z-index: 1;">
                <div class="text-center mb-5 mx-auto" style="max-width: 36rem;">
                    <span class="d-inline-flex align-items-center px-3 py-1 rounded-pill mb-3" style="border: 1px solid rgba(13,148,136,0.3); background: rgba(13,148,136,0.1);">
                        <span class="small fw-semibold" style="color: var(--md-sys-color-primary);">Fitur Unggulan</span>
                    </span>
                    <h2 class="fw-black mb-3" style="font-size: clamp(1.75rem, 4vw, 2.75rem); line-height: 1.15; letter-spacing: -0.03em; color: var(--md-sys-color-on-surface);">
                        Semua yang Anda <span class="text-gradient">Butuhkan</span>
                    </h2>
                    <p class="" style="color: var(--md-sys-color-on-surface-variant);">
                        Platform lengkap untuk mengelola absensi dengan efisien dan akurat.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card-premium h-100 p-4 p-lg-4 card-stagger card-stagger-1" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                            <div class="icon-premium mb-3" style="background: var(--md-sys-color-primary-container); color: var(--md-sys-color-primary);">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--md-sys-color-on-surface);">Real-time Tracking</h3>
                            <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Catat kehadiran secara langsung dan pantau status kehadiran secara real-time dari mana saja.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card-premium h-100 p-4 p-lg-4 card-stagger card-stagger-2" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.25);">
                            <div class="icon-premium mb-3" style="background: rgba(16,185,129,0.1); color: #10B981;">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--md-sys-color-on-surface);">Laporan Detail</h3>
                            <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Generate laporan absensi lengkap dengan grafik dan statistik yang mudah dipahami.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card-premium h-100 p-4 p-lg-4 card-stagger card-stagger-3" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.25);">
                            <div class="icon-premium mb-3" style="background: rgba(245,158,11,0.1); color: #F59E0B;">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--md-sys-color-on-surface);">Keamanan Data</h3>
                            <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Data tersimpan dengan enkripsi dan dapat diakses kapan saja dengan aman.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card-premium h-100 p-4 p-lg-4 card-stagger card-stagger-4" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.25);">
                            <div class="icon-premium mb-3" style="background: rgba(239,68,68,0.1); color: var(--md-sys-color-error);">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--md-sys-color-on-surface);">Notifikasi Otomatis</h3>
                            <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Kirim notifikasi ke orang tua saat siswa absen atau terlambat secara otomatis.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card-premium h-100 p-4 p-lg-4 card-stagger card-stagger-5" style="--card-border:#0891B2;--card-glow:rgba(8,145,178,0.25);">
                            <div class="icon-premium mb-3" style="background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-secondary);">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--md-sys-color-on-surface);">Multi Role</h3>
                            <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Akses berbeda untuk admin, guru, dan siswa dengan hak akses yang terstruktur.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card-premium h-100 p-4 p-lg-4 card-stagger card-stagger-6" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                            <div class="icon-premium mb-3" style="background: rgba(13,148,136,0.15); color: #0D9488;">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--md-sys-color-on-surface);">Mobile Friendly</h3>
                            <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Akses dari perangkat apapun dengan tampilan yang responsif dan optimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Gradient bridge to Services --}}
        <div class="section-gradient-bottom"></div>

        {{-- Services Section --}}
        <section id="services" class="section-premium" style="background: var(--md-sys-color-surface);">
            <div class="container" style="max-width: 1200px;">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <span class="d-inline-flex align-items-center px-3 py-1 rounded-pill mb-3" style="border: 1px solid rgba(13,148,136,0.3); background: rgba(13,148,136,0.1);">
                            <span class="small fw-semibold" style="color: var(--md-sys-color-primary);">Layanan Kami</span>
                        </span>
                        <h2 class="fw-black mb-3" style="font-size: clamp(1.75rem, 4vw, 2.75rem); line-height: 1.15; letter-spacing: -0.03em; color: var(--md-sys-color-on-surface);">
                            Solusi Lengkap untuk <span class="text-gradient">Sekolah</span>
                        </h2>
                        <p class=" mb-4" style="color: var(--md-sys-color-on-surface-variant);">
                            Kami menyediakan berbagai layanan untuk membantu sekolah mengelola absensi dengan lebih efisien.
                        </p>

                        <div class="d-flex flex-column gap-3">
                            <div class="service-item d-flex gap-3 p-3 p-lg-4" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                                <div class="icon-premium flex-shrink-0" style="width: 48px; height: 48px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-primary);">
                                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1" style="font-size: 1rem; color: var(--md-sys-color-on-surface);">Manajemen Siswa</h4>
                                    <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Kelola data siswa, kelas, dan jadwal dengan mudah dalam satu platform.</p>
                                </div>
                            </div>

                            <div class="service-item d-flex gap-3 p-3 p-lg-4" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.25);">
                                <div class="icon-premium flex-shrink-0" style="width: 48px; height: 48px; background: rgba(16,185,129,0.1); color: #10B981;">
                                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1" style="font-size: 1rem; color: var(--md-sys-color-on-surface);">Laporan &amp; Analitik</h4>
                                    <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Dapatkan insight mendalam dengan laporan yang detail dan visualisasi data.</p>
                                </div>
                            </div>

                            <div class="service-item d-flex gap-3 p-3 p-lg-4" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.25);">
                                <div class="icon-premium flex-shrink-0" style="width: 48px; height: 48px; background: rgba(245,158,11,0.1); color: #F59E0B;">
                                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1" style="font-size: 1rem; color: var(--md-sys-color-on-surface);">Integrasi Mudah</h4>
                                    <p class=" mb-0" style="color: var(--md-sys-color-on-surface-variant);">Terhubung dengan sistem lain yang sudah digunakan sekolah Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="row g-3">
                            <div class="col-6">
                            <div class="stat-card-premium text-center p-4 p-lg-4" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                                <div class="icon-premium mx-auto mb-3" style="width: 52px; height: 52px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-primary);">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <p class="fw-black mb-0 lh-1 text-gradient" style="font-size: clamp(1.5rem, 3.5vw, 2.2rem); font-weight: 500">1,200+</p>
                                <p class="small mb-0 mt-2 fw-medium" style="color: var(--md-sys-color-on-surface-variant);">Siswa Terdaftar</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card-premium text-center p-4 p-lg-4" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.25);">
                                <div class="icon-premium mx-auto mb-3" style="width: 52px; height: 52px; background: rgba(16,185,129,0.1); color: #10B981;">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="fw-black mb-0 lh-1 text-gradient" style="font-size: clamp(1.5rem, 3.5vw, 2.2rem); font-weight: 500">98%</p>
                                <p class="small mb-0 mt-2 fw-medium" style="color: var(--md-sys-color-on-surface-variant);">Akurasi Data</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card-premium text-center p-4 p-lg-4" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.25);">
                                <div class="icon-premium mx-auto mb-3" style="width: 52px; height: 52px; background: rgba(245,158,11,0.1); color: #F59E0B;">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="fw-black mb-0 lh-1 text-gradient" style="font-size: clamp(1.5rem, 3.5vw, 2.2rem); font-weight: 500">24/7</p>
                                <p class="small mb-0 mt-2 fw-medium" style="color: var(--md-sys-color-on-surface-variant);">Akses Online</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card-premium text-center p-4 p-lg-4" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.25);">
                                <div class="icon-premium mx-auto mb-3" style="width: 52px; height: 52px; background: rgba(239,68,68,0.1); color: var(--md-sys-color-error);">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                </div>
                                <p class="fw-black mb-0 lh-1 text-gradient" style="font-size: clamp(1.5rem, 3.5vw, 2.2rem); font-weight: 500">Instant</p>
                                <p class="small mb-0 mt-2 fw-medium" style="color: var(--md-sys-color-on-surface-variant);">Notifikasi</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Gradient bridge to Stats --}}
        <div class="section-gradient-top-suf"></div>

        {{-- Stats Section --}}
        <section id="stats" class="section-compact" style="background: var(--md-sys-color-surface-container);">
            <div class="container" style="max-width: 1200px;">
                <div class="text-center mb-5 mx-auto" style="max-width: 36rem;">
                    <span class="d-inline-flex align-items-center px-3 py-1 rounded-pill mb-3" style="border: 1px solid rgba(13,148,136,0.3); background: rgba(13,148,136,0.1);">
                        <span class="small fw-semibold" style="color: var(--md-sys-color-primary);">Statistik</span>
                    </span>
                    <h2 class="fw-black mb-3" style="font-size: clamp(1.75rem, 4vw, 2.75rem); line-height: 1.15; letter-spacing: -0.03em; color: var(--md-sys-color-on-surface);">
                        Dipercaya oleh <span class="text-gradient">Ratusan</span> Sekolah
                    </h2>
                </div>

                <div class="row g-4 g-lg-5 text-center">
                    <div class="col-6 col-lg-3">
                        <div class="stat-premium">
                            <p class="fw-black mb-1" style="font-weight: 500; font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1; background: linear-gradient(135deg, var(--md-sys-color-primary), #818CF8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">500+</p>
                            <p class="fw-medium mb-0" style="color: var(--md-sys-color-on-surface-variant); letter-spacing: 0.02em;">Sekolah</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat-premium">
                            <p class="fw-black mb-1" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1; background: linear-gradient(135deg, #10B981, #34D399); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">50K+</p>
                            <p class="fw-medium mb-0" style="color: var(--md-sys-color-on-surface-variant); letter-spacing: 0.02em;">Siswa</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat-premium">
                            <p class="fw-black mb-1" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1; background: linear-gradient(135deg, #F59E0B, #FBBF24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">5M+</p>
                            <p class="fw-medium mb-0" style="color: var(--md-sys-color-on-surface-variant); letter-spacing: 0.02em;">Absensi</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat-premium">
                            <p class="fw-black mb-1" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1; background: linear-gradient(135deg, var(--md-sys-color-tertiary), #22D3EE); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">99%</p>
                            <p class="fw-medium mb-0" style="color: var(--md-sys-color-on-surface-variant); letter-spacing: 0.02em;">Uptime</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Gradient bridge to Testimonials --}}
        <div class="section-gradient-top"></div>

        {{-- Testimonials Section --}}
        <section id="testimonials" class="section-premium position-relative" style="background: var(--md-sys-color-surface-container); padding-bottom: 24px; margin-bottom: 0; overflow: visible; overflow-x: clip;">
            <div class="container position-relative" style="max-width: 1200px; z-index: 1;">
                <div class="text-center mb-5 mx-auto" style="max-width: 36rem;">
                    <span class="d-inline-flex align-items-center px-3 py-1 rounded-pill mb-3" style="border: 1px solid rgba(13,148,136,0.3); background: rgba(13,148,136,0.1);">
                        <span class="small fw-semibold" style="color: var(--md-sys-color-primary);">Testimoni</span>
                    </span>
                    <h2 class="fw-black mb-3" style="font-size: clamp(1.75rem, 4vw, 2.75rem); line-height: 1.15; letter-spacing: -0.03em; color: var(--md-sys-color-on-surface);">
                        Apa Kata <span class="text-gradient">Mereka</span>
                    </h2>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card h-100 p-4 p-lg-4 card">
                            <div class="quote-mark">"</div>
                            <div class="d-flex align-items-center gap-1 mb-3" style="color: #F59E0B;">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                            </div>
                            <p class=" mb-4 flex-grow-1" style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">"Present sangat membantu kami dalam mengelola absensi. Laporan yang dihasilkan sangat detail dan mudah dipahami."</p>
                            <div class="d-flex align-items-center gap-3 mt-auto">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: var(--md-sys-color-primary-container); border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                                    <span class="fw-bold" style="font-size: 0.85rem; color: var(--md-sys-color-primary);">DR</span>
                                </div>
                                <div>
                                    <p class="fw-semibold mb-0" style="font-size: 0.9rem; color: var(--md-sys-color-on-surface);">Dewi Rahayu</p>
                                    <p class="small mb-0" style="color: var(--md-sys-color-on-surface-variant);">Kepala Sekolah</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card h-100 p-4 p-lg-4 card">
                            <div class="quote-mark">"</div>
                            <div class="d-flex align-items-center gap-1 mb-3" style="color: #F59E0B;">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                            </div>
                            <p class=" mb-4 flex-grow-1" style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">"Sebagai guru, saya sangat terbantu dengan fitur absensi digital ini. Proses pencatatan menjadi lebih cepat dan efisien."</p>
                            <div class="d-flex align-items-center gap-3 mt-auto">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: rgba(16,185,129,0.1); border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                                    <span class="fw-bold" style="font-size: 0.85rem; color: #10B981;">AS</span>
                                </div>
                                <div>
                                    <p class="fw-semibold mb-0" style="font-size: 0.9rem; color: var(--md-sys-color-on-surface);">Ahmad Surya</p>
                                    <p class="small mb-0" style="color: var(--md-sys-color-on-surface-variant);">Guru Matematika</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card h-100 p-4 p-lg-4 card">
                            <div class="quote-mark">"</div>
                            <div class="d-flex align-items-center gap-1 mb-3" style="color: #F59E0B;">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                            </div>
                            <p class=" mb-4 flex-grow-1" style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">"Orang tua saya senang karena bisa langsung tahu kalau saya hadir di sekolah. Sistemnya sangat membantu!"</p>
                            <div class="d-flex align-items-center gap-3 mt-auto">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: rgba(245,158,11,0.1); border: 2px solid var(--md-sys-color-surface); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                                    <span class="fw-bold" style="font-size: 0.85rem; color: #F59E0B;">FN</span>
                                </div>
                                <div>
                                    <p class="fw-semibold mb-0" style="font-size: 0.9rem; color: var(--md-sys-color-on-surface);">Fajar Nugroho</p>
                                    <p class="small mb-0" style="color: var(--md-sys-color-on-surface-variant);">Siswa Kelas 11</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section><div id="cta-bridge" style="height: 7rem; background: linear-gradient(to bottom, var(--md-sys-color-surface-container) 20%, #5EEAD4 100%); display:block; margin:0; padding:0; margin-top:-1px; margin-bottom: -1px"></div><section id="cta-section" class="section-premium" style="background: linear-gradient(180deg, #5EEAD4 0%, #0D9488 25%, #0F766E 70%); position: relative; overflow: hidden; padding-top: 48px;">
            <div class="py-3 text-center position-relative px-4" style="z-index: 1;">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-4" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.3);">
                    <span class="rounded-circle" style="width: 5px; height: 5px; background: #fff;"></span>
                    <span class="small fw-semibold" style="color: rgba(255,255,255,0.8); letter-spacing: 0.02em;">GRATIS COBA 14 HARI</span>
                </div>
                <h2 class="fw-black mb-3" style="font-size: clamp(1.75rem, 4vw, 2.75rem); line-height: 1.15; letter-spacing: -0.03em; color: #fff;">
                    Siap <span style="border-bottom: 3px solid rgba(255,255,255,0.25);">Memulai</span>?
                </h2>
                <p class="mb-4 mx-auto" style="font-size: clamp(0.95rem, 2vw, 1.1rem); line-height: 1.65; color: rgba(255,255,255,0.85); max-width: 36rem;">
                    Bergabung dengan ratusan sekolah yang sudah menggunakan Present untuk mengelola absensi mereka.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-light landing-btn" style="color: var(--md-sys-color-primary); box-shadow: 0 8px 32px rgba(0,0,0,0.2);">
                            <i class="bi bi-speedometer2 me-2"></i> Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-premium landing-btn" style="background: white; color: #0D9488; box-shadow: 0 8px 32px rgba(0,0,0,0.2);">
                            <i class="bi bi-arrow-right me-2"></i> Mulai Sekarang
                        </a>
                        <a href="#features" class="btn btn-premium landing-btn" style="background: transparent; color: white; border: 2px solid rgba(255,255,255,0.6);">
                            <i class="bi bi-play-circle me-2"></i> Coba Demo
                        </a>
                    @endauth
                </div>
            </div>
        </section>
    </main>
    <div id="footer-bridge" style="height: 7rem; display:block; margin:0; padding:0; margin-top:-1px; margin-bottom:-1px;"></div>
    <footer id="main-footer" style="background: #115E59; padding-top: 0;">
        <div class="container py-5" style="max-width: 1200px;">
            <div class="row g-4 g-lg-5 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                <div class="col-12 col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('logo_dark2.png') }}" alt="Present" style="width:36px;height:36px;object-fit:contain;" />
                        <span class="fw-bold" style="font-size: 1.2rem; color: var(--md-sys-color-inverse-on-surface);">Present</span>
                    </div>
                    <p class="small mb-3" style="color: rgba(255,255,255,0.6); max-width: 36ch; line-height: 1.7;">Sistem absensi digital untuk sekolah modern Indonesia. Dipercaya 500+ sekolah.</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); text-decoration: none; transition: all 0.2s;">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); text-decoration: none; transition: all 0.2s;">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); text-decoration: none; transition: all 0.2s;">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>
                <div class="col-4 col-lg-2 offset-lg-1">
                    <h5 class="fw-semibold mb-2" style="font-size: 0.8rem; color: var(--md-sys-color-inverse-on-surface); letter-spacing: 0.03em;">Produk</h5>
                    <ul class="list-unstyled d-flex flex-column gap-1">
                        <li><a href="#features" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Fitur</a></li>
                        <li><a href="#services" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Layanan</a></li>
                        <li><a href="#stats" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Statistik</a></li>
                    </ul>
                </div>
                <div class="col-4 col-lg-2">
                    <h5 class="fw-semibold mb-2" style="font-size: 0.8rem; color: var(--md-sys-color-inverse-on-surface); letter-spacing: 0.03em;">Perusahaan</h5>
                    <ul class="list-unstyled d-flex flex-column gap-1">
                        <li><a href="#" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Tentang</a></li>
                        <li><a href="#" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Kontak</a></li>
                        <li><a href="#" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Karir</a></li>
                    </ul>
                </div>
                <div class="col-4 col-lg-2">
                    <h5 class="fw-semibold mb-2" style="font-size: 0.8rem; color: var(--md-sys-color-inverse-on-surface); letter-spacing: 0.03em;">Legal</h5>
                    <ul class="list-unstyled d-flex flex-column gap-1">
                        <li><a href="#" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Privasi</a></li>
                        <li><a href="#" class="footer-link" style="color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: all 0.2s;">Ketentuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between pt-3 gap-1">
                <p class="small mb-0" style="color: rgba(255,255,255,0.45); font-size: 0.75rem;">Present &copy; {{ date('Y') }}. All rights reserved.</p>
                <p class="small mb-0" style="color: rgba(255,255,255,0.45); font-size: 0.75rem;">Made with <span style="color: #EF4444;">&hearts;</span> for Indonesian Education</p>
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var listEl = document.getElementById('attendance-list');
            var emptyEl = document.getElementById('attendance-empty');
            var pctHadir = document.getElementById('pct-hadir');
            var pctTelat = document.getElementById('pct-telat');
            var pctAlfa = document.getElementById('pct-alfa');
            var liveTime = document.getElementById('live-time');

            var avatarColors = [
                { bg: 'var(--avatar-1-bg)', fg: 'var(--avatar-1-fg)', glow: 'var(--avatar-1-glow)', border: 'var(--avatar-1-fg)' },
                { bg: 'var(--avatar-2-bg)', fg: 'var(--avatar-2-fg)', glow: 'var(--avatar-2-glow)', border: 'var(--avatar-2-fg)' },
                { bg: 'var(--avatar-3-bg)', fg: 'var(--avatar-3-fg)', glow: 'var(--avatar-3-glow)', border: 'var(--avatar-3-fg)' },
                { bg: 'var(--avatar-4-bg)', fg: 'var(--avatar-4-fg)', glow: 'var(--avatar-4-glow)', border: 'var(--avatar-4-fg)' },
                { bg: 'var(--avatar-5-bg)', fg: 'var(--avatar-5-fg)', glow: 'var(--avatar-5-glow)', border: 'var(--avatar-5-fg)' },
                { bg: 'var(--avatar-6-bg)', fg: 'var(--avatar-6-fg)', glow: 'var(--avatar-6-glow)', border: 'var(--avatar-6-fg)' },
            ];

            function renderRow(r, index) {
                var ac = avatarColors[index % avatarColors.length];
                return '<div class="col-12">'
                    + '<div class="attendance-item d-flex align-items-center rounded-4" style="background:var(--md-sys-color-surface-container);border:1px solid var(--md-sys-color-outline-variant);--card-border:' + ac.border + ';--card-glow:' + ac.glow + ';">'
                    + '<div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: ' + ac.bg + ';">'
                    + '<span class="fw-bold" style="color: ' + ac.fg + ';">' + r.inisial + '</span>'
                    + '</div>'
                    + '<div class="min-w-0 flex-grow-1">'
                    + '<p class="fw-semibold mb-1 text-truncate" style="color:var(--md-sys-color-on-surface);line-height:1.3;">' + r.nama + '</p>'
                    + '<p class="mb-0 text-truncate" style="color:var(--md-sys-color-on-surface-variant);line-height:1.2;">Kelas ' + r.kelas + '</p>'
                    + '</div>'
                    + '</div>'
                    + '</div>';
            }

            function fetchKehadiran() {
                fetch('/api/kehadiran-hari-ini')
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        if (data.records && data.records.length > 0) {
                            listEl.classList.remove('d-none');
                            emptyEl.classList.add('d-none');
                            var html = '';
                            var maxItems = Math.min(data.records.length, 4);
                            for (var i = 0; i < maxItems; i++) {
                                html += renderRow(data.records[i], i);
                            }
                            listEl.innerHTML = html;
                            if (data.records.length > 0 && liveTime) {
                                liveTime.textContent = data.records[0].waktu;
                            }
                        } else {
                            listEl.classList.add('d-none');
                            emptyEl.classList.remove('d-none');
                        }
                        if (data.summary) {
                            pctHadir.textContent = data.summary.hadir + '%';
                            pctTelat.textContent = data.summary.telat + '%';
                            pctAlfa.textContent = data.summary.alfa + '%';
                        }
                    })
                    .catch(function() {});
            }

            fetchKehadiran();
            setInterval(fetchKehadiran, 10000);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.nav-link-offcanvas').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var target = this.getAttribute('href');
                var offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('navDrawer'));
                if (offcanvas) offcanvas.hide();
                if (target && target.startsWith('#')) {
                    var el = document.querySelector(target);
                    if (el) {
                        setTimeout(function() {
                            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 300);
                    }
                }
            });
        });
    </script>
    </body>
</html>
