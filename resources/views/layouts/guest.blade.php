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
    <body>
    <header class="bg-black text-white rounded-lg mx-4 my-4">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">

        <div class="logo text-xl font-bold">
            <a href="/" class="hover:text-gray-400 transition duration-300 ease-in-out">CRM</a>
        </div>

        <div class="nav flex space-x-6">
            <a href="/login" class="hover:text-green-400 transition duration-300 ease-in-out">Login</a>
            <a href="/register" class="hover:text-green-400 transition duration-300 ease-in-out">Register</a>
            <a href="{{route('contact')}}" class="hover:text-green-400 transition duration-300 ease-in-out">Contact</a>
        </div>
    </div>
</header>


        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>
        <footer>
            <div class="container text-center">
                &copy; footer
            </div>
        </footer>

        @livewire('business.register')

        @livewireScripts
    </body>
</html>
