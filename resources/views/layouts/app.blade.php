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
    <nav class="bg-gray-800 text-white px-6 py-4">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Left Section: Logo and Links -->
            <div class="flex items-center space-x-6">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('chatcord_logo.ico') }}" alt="Chatcord Logo" class="h-8 w-8 hidden sm:block">
                    <span class="text-xl font-bold hidden sm:block">Chatcord</span>
                </div>
                <!-- Links -->
                @auth
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold hover:text-gray-400">Home</a>
                @else
                    <a href="{{ route('home') }}" class="text-xl font-bold hover:text-gray-400">Home</a>
                @endauth
                <a href="{{ route('posts.index') }}" class="text-xl font-bold hover:text-gray-400">Posts</a>
            </div>

            <!-- Right Section: Create Post Button and User Section -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Create Post Button -->
                    <a href="{{ route('posts.create') }}"
                        class="px-4 py-2 bg-blue-900 text-white rounded-lg font-medium hover:bg-blue-800 transition">
                        Create Post
                    </a>
                @endauth

                <!-- User Section -->
                <div class="relative">
                    @auth
                        <!-- Profile Dropdown Trigger -->
                        <button id="profileDropdownButton"
                            class="flex items-center space-x-2 hover:text-gray-400 focus:outline-none">
                            <span>Profile</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Profile Dropdown Menu -->
                        <div id="profileDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded shadow-lg z-10">
                            <a href="{{ route('profile.show', auth()->user()->id) }}"
                                class="block px-4 py-2 hover:bg-gray-100">
                                <div>
                                    View Profile
                                    <div class="text-xs text-gray-500">{{ '@' . auth()->user()->username }}</div>
                                </div>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Login and Register Links -->
                        <a href="{{ route('login') }}" class="mr-4 hover:text-gray-400">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-400">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>



    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Livewire Scripts -->
    @livewireScripts

    @vite(['public/js/profile-dropdown.js'])
</body>

</html>