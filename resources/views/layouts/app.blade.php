<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        @include('sweetalert::alert')
        <x-banner />

        <div x-data="{ 
            sidebar: true,
            handleResize() {
                if (window.innerWidth < 768) {
                    this.sidebar = false;
                }
            }
        }" 
        x-init="handleResize(); window.addEventListener('resize', () => handleResize())"
        class="relative min-h-screen"
        >
            <!-- Mobile Overlay -->
            <div 
                x-show="sidebar" 
                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebar = false"
                class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-30 md:hidden"
            ></div>

            <!-- Toggle Button - Always visible -->
            <button 
                @click="sidebar = !sidebar"
                class="fixed top-4 left-4 z-50 p-2 rounded-lg bg-gray-800 text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 transition-colors"
            >
                <svg x-show="!sidebar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="sidebar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            @livewire('sidebar')
            <!-- Main Content Area -->
            <div 
                x-bind:class="{ 'md:pl-64': sidebar }"
                class="transition-all duration-300"
            >
                <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                    <!-- Top Navigation -->
                    <div class="sticky top-0 z-20 bg-white dark:bg-gray-800 shadow">
                        <div class="pl-16 md:pl-20">
                            @livewire('navigation-menu')
                        </div>
                    </div>

                    <!-- Page Header -->
                    @if (isset($header))
                        <header class="bg-white dark:bg-gray-800 shadow-sm">
                            <div class="pl-16 md:pl-20 max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Main Content -->
                    <main class="pl-4 md:pl-4">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <div wire:loading.delay class="fixed top-0 left-0 w-full h-full bg-blue-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>

        @stack('modals')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
    </body>
</html>