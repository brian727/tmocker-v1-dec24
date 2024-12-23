
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Tmocker') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <nav class="bg-gray-800 p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex space-x-4">
                    <a href="/" class="text-white" wire:navigate>Home</a>
                    <a href="/summit" class="text-white" wire:navigate>Start Summit</a>
                    <a href="/my-summits" class="text-white" wire:navigate>My Summits</a>
                    <a href="/leaderboard" class="text-white" wire:navigate>Leaderboard</a>
                </div>
                @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-white">{{ Auth::user()->name }}</span>
                        <a href="/profile" class="text-white" wire:navigate>Profile</a>
                    </div>
                @endauth
            </div>
        </nav>

            <!-- Page Content -->
            <main>
                {{ $slot }}
               
            </main>
            @livewireScripts
    </body>
</html>
