<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('chatcord_logo.ico') }}">

    <title>Chatcord</title>
    
    <!-- Vite Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Links Section -->
            <div class="flex space-x-6">
                <!-- Home Link -->
                <a href="{{ route('dashboard') }}" class="text-xl font-bold hover:text-gray-400">Home</a>
                <!-- Posts Link -->
                <a href="{{ route('posts.index') }}" class="text-xl font-bold hover:text-gray-400">Posts</a>
            </div>
            
            <div>
                @auth
                    <!-- Create Post Link -->
                    <a href="{{ route('posts.create') }}" class="mr-4 hover:text-gray-400">Create Post</a>
                    <!-- Profile Link -->
                    <a href="{{ route('profile.show', auth()->user()->id) }}" class="mr-4 hover:text-gray-400">Profile</a>
                    
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-gray-400">Logout</button>
                    </form>
                @else
                    <!-- Login Link -->
                    <a href="{{ route('login') }}" class="mr-4 hover:text-gray-400">Login</a>
                    <!-- Register Link -->
                    <a href="{{ route('register') }}" class="hover:text-gray-400">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Livewire Scripts -->
   
    @livewireScripts
</body>
</html>

