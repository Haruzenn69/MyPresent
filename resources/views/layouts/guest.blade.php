<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }" x-init="() => { if (dark) document.documentElement.classList.add('dark'); $watch('dark', val => { if (val) { document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); } else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); } }) }" :class="{ 'dark': dark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Present') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --surface: #FFFFFF;
        }
        .dark {
            --surface: #2d2d2d;
        }
        .dark .guest-body {
            background: linear-gradient(135deg, #0F766E, #155E75) !important;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="guest-body" style="background: linear-gradient(135deg, #0D9488, #0891B2);">
    {{-- Decorative shapes behind blur --}}
    <div class="position-fixed w-100 h-100 overflow-hidden" style="pointer-events: none; z-index: 0;">
        <div style="position:absolute;top:-10%;right:-5%;width:45vw;height:45vw;max-width:500px;max-height:500px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.15) 0%,transparent 70%);"></div>
        <div style="position:absolute;bottom:-15%;left:-10%;width:55vw;height:55vw;max-width:600px;max-height:600px;border-radius:50%;background:radial-gradient(circle,rgba(8,145,178,0.25) 0%,transparent 70%);"></div>
        <div style="position:absolute;top:40%;left:50%;transform:translate(-50%,-50%);width:60vw;height:60vw;max-width:700px;max-height:700px;border-radius:50%;background:radial-gradient(circle,rgba(13,148,136,0.2) 0%,transparent 70%);"></div>
    </div>

    {{-- Backdrop blur overlay (modal dim/blur) --}}
    <div class="position-fixed w-100 h-100" style="z-index:1;pointer-events:none;backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);"></div>

    {{-- Content on top of blur --}}
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-4 px-3 position-relative" style="z-index: 2;">
        <a href="/" class="text-decoration-none mb-4 text-center">
            <a href="/" class="text-decoration-none mb-4 text-center d-inline-flex flex-column align-items-center">
                <img src="{{ asset('logo_dark2.png') }}" alt="Present" style="width:48px;height:48px;object-fit:contain;margin-bottom:0.5rem;" />
                <div class="fw-bold fs-3 text-white">Present</div>
            <p class="text-white mb-0" style="opacity:0.7;font-size:0.875rem;">Sistem Absensi Sekolah</p>
        </a>

        <div class="card guest-card shadow-lg border-0 rounded-4 w-100" style="max-width:420px;background:var(--surface);">
            <div class="card-body p-4 p-md-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
