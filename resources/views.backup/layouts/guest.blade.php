<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="theme" x-init="init()" :class="{ 'dark': dark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Present') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-10 px-4 bg-gray-50 dark:bg-dark-bg">
            <a href="/" class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                <div class="avatar avatar-md bg-present-600">
                    <x-application-logo class="w-6 h-6 sm:w-7 sm:h-7 text-white" />
                </div>
                <span class="font-extrabold text-xl sm:text-2xl text-gray-900 dark:text-white">Present</span>
            </a>

            <div class="w-full sm:max-w-md mt-4 px-6 sm:px-8 py-6 sm:py-8 card overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
