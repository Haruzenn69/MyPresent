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
                --primary: #0D9488;
                --primary-dark: #0F766E;
                --primary-light: #EDE7F6;
                --success: #2E7D32;
                --success-light: #E8F5E9;
                --warning: #E65100;
                --warning-light: #FFF3E0;
                --danger: #C62828;
                --danger-light: #FFEBEE;
                --info: #00695C;
                --info-light: #E0F2F1;
                --neutral: #546E7A;
                --neutral-light: #ECEFF1;
                --surface: #FFFFFF;
                --background: #F5F5F5;
                --text-primary: #212121;
                --text-secondary: #757575;
                --border: #E0E0E0;
            }

            .dark {
                --primary-light: #1A2E2C;
                --success-light: #1A2E1A;
                --warning-light: #2E1A00;
                --danger-light: #2E1A1A;
                --info-light: #0A2E2C;
                --neutral-light: #2A2A2A;
                --surface: #1f1f1f;
                --background: #1a1a1a;
                --text-primary: #E8E8E8;
                --text-secondary: #AAAAAA;
                --border: #404040;
            }

            body {
                background: var(--background);
            }
            .dark body {
                background: var(--background);
            }

            .stat-card {
                min-width: 80px;
                padding: 12px 8px;
                border-radius: 12px;
                text-align: center;
                flex: 1;
            }
            .stat-card .stat-number {
                font-size: 24px;
                font-weight: 700;
                line-height: 1.2;
            }
            .stat-card .stat-label {
                font-size: 11px;
                color: var(--text-secondary);
                margin-top: 4px;
            }
            .stat-card.stat-hadir { background: var(--success-light); color: var(--success); }
            .stat-card.stat-izin { background: var(--primary-light); color: var(--primary); }
            .stat-card.stat-sakit { background: var(--info-light); color: var(--info); }
            .stat-card.stat-alfa { background: var(--danger-light); color: var(--danger); }
            .stat-card.stat-terlambat { background: var(--warning-light); color: var(--warning); }

            .dark .stat-card.stat-hadir { color: #4ADE80; }
            .dark .stat-card.stat-izin { color: #2DD4BF; }
            .dark .stat-card.stat-sakit { color: #22D3EE; }
            .dark .stat-card.stat-alfa { color: #F87171; }
            .dark .stat-card.stat-terlambat { color: #FB923C; }

            .btn-ghost {
                background: var(--neutral-light);
                border: none;
                color: var(--text-secondary);
                border-radius: 8px;
            }
            .btn-ghost:hover {
                background: #CFD8DC;
                color: var(--text-primary);
            }
            .dark .btn-ghost:hover {
                background: #3a3a3a;
            }

        .content-wrapper {
            padding: 0;
        }
        </style>
    </head>
    <body>
        <div class="d-flex flex-column" style="min-height: 100vh;" id="app-layout">
            @include('layouts.navigation')

            @isset($header)
                <div style="background:linear-gradient(135deg,var(--md-sys-color-primary),#0F766E);padding:1rem 0;">
                    {!! $header !!}
                </div>
            @endisset

            <main class="flex-grow-1">
                <div class="content-wrapper">
                    @isset($slot)
                        {{ $slot }}
                    @endisset
                    @yield('content')
                </div>
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
