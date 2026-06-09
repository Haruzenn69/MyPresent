<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ mobileMenu: false, ...theme }" x-init="init()" :class="{ 'dark': dark }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Design Preview - Present</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50 dark:bg-dark-bg">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white dark:bg-dark-card border-b-2 border-gray-900 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Design Preview</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">A showcase of UI components matching the Figma prototype style.</p>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <section class="py-12">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <!-- Button Variants -->
                            <div class="card p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Buttons</h2>
                                <div class="space-y-3">
                                    <x-primary-button>Primary</x-primary-button>
                                    <x-secondary-button>Secondary (Outline)</x-secondary-button>
                                    <x-danger-button>Danger</x-danger-button>
                                    <button class="btn btn-ghost">Ghost</button>
                                    <button class="btn btn-black">Black</button>
                                </div>
                            </div>

                            <!-- Inputs -->
                            <div class="card p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Form Elements</h2>
                                <div class="space-y-4">
                                    <x-input-label for="email" value="Email Address" />
                                    <x-text-input id="email" type="email" placeholder="you@example.com" />
                                    <x-input-label for="password" value="Password" />
                                    <x-text-input id="password" type="password" placeholder="••••••••" />
                                    <div class="flex items-center space-x-3">
                                        <x-checkbox id="remember" name="remember" checked>false</x-checkbox>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                                    </div>
                                    <x-input-label :messages="['Password must be at least 8 characters']" />
                                </div>
                            </div>

                            <!-- Cards -->
                            <div class="col-span-2 card p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Card Variants</h2>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div class="card p-4">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Default Card</h3>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Standard card with padding.</p>
                                    </div>
                                    <div class="card-border p-4">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Card Border</h3>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Card with border only.</p>
                                    </div>
                                    <div class="card-hover p-4">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Hover Card</h3>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Lifts on hover.</p>
                                    </div>
                                    <div class="stat-card p-4 text-center">
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">124</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Active Users</p>
                                    </div>
                                    <div class="stat-card-border p-4 text-center">
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">98%</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Uptime</p>
                                    </div>
                                    <div class="card p-4 dotted-grid">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Dotted Grid</h3>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Background with dot pattern.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Nav Links -->
                            <div class="card p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Navigation Links</h2>
                                <div class="space-y-2">
                                    <x-nav-link :active="true">Dashboard</x-nav-link>
                                    <x-nav-link :active="false">Students</x-nav-link>
                                    <x-nav-link :active="false">Attendance</x-nav-link>
                                    <x-nav-link :active="false">Reports</x-nav-link>
                                </div>
                            </div>

                            <!-- Badges -->
                            <div class="card p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Badges</h2>
                                <div class="flex flex-wrap gap-2">
                                    <span class="badge badge-blue">Blue</span>
                                    <span class="badge badge-green">Green</span>
                                    <span class="badge badge-yellow">Yellow</span>
                                    <span class="badge badge-red">Red</span>
                                    <span class="badge badge-gray">Gray</span>
                                </div>
                            </div>

                            <!-- Modal Trigger -->
                            <div class="card p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Modal</h2>
                                <button @click="showModal = true" class="btn btn-primary">
                                    Open Modal
                                </button>

                                <x-modal name="design-modal" :show="showModal" @click.outside="showModal = false">
                                    <div class="space-y-4">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Modal Title</h3>
                                        <p class="text-gray-600 dark:text-gray-400">This is a sample modal using the updated card-border style.</p>
                                        <div class="flex justify-end space-x-3">
                                            <x-secondary-button @click="showModal = false">Close</x-secondary-button>
                                            <x-primary-button @click="showModal = false">Save Changes</x-primary-button>
                                        </div>
                                    </div>
                                </x-modal>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        <script>
            // Alpine data for modal control
            document.addEventListener('alpine:init', () => {
                Alpine.data('designPreview', () => ({
                    showModal: false
                }))
            })
        </script>
    </body>
</html>