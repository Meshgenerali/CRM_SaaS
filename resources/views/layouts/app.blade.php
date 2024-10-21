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

            <!-- Sidebar -->
<!-- Sidebar -->
<div 
    x-show="sidebar"
    x-transition:enter="transform transition-transform duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition-transform duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-800 shadow-lg"
>
    <div class="flex flex-col h-full">
        <!-- Sidebar Header -->
        <div class="flex items-center h-16 px-6 bg-gray-800">
            <h1 class="text-xl font-semibold text-white">{{ config('app.name', 'Laravel') }}</h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">

            <!-- Users Menu -->
            <div x-data="{ open: false }">
                <a @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-sm font-medium group-hover:text-white">Users</span>
                    <svg class="ml-auto h-5 w-5 transition-transform transform" :class="open ? 'rotate-180' : 'rotate-0'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                
                <!-- Sub-links for Users -->
                <div x-show="open" x-collapse class="ml-6 mt-2 space-y-1">
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 1</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 2</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 3</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 3</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 3</a>
                </div>
            </div>

            <!-- Settings Menu -->
            <div x-data="{ open: false }">
                <a @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm font-medium group-hover:text-white">Settings</span>
                    <svg class="ml-auto h-5 w-5 transition-transform transform" :class="open ? 'rotate-180' : 'rotate-0'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                
                <!-- Sub-links for Settings -->
                <div x-show="open" x-collapse class="ml-6 mt-2 space-y-1">
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 1</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 2</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 3</a>
                </div>
            </div>

            <!-- Other navigation items... -->
        </nav>
    </div>
</div>


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
                    <main class="pl-16 md:pl-20">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>