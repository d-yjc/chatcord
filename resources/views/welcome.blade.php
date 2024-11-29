<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50">
    <div class="min-h-screen flex flex-col justify-between">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            Welcome to Chatcord
                        </h1>
                    </div>
                    <nav>
                        @if (Route::has('login'))
                            <div class="flex space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-4xl mx-auto py-12 px-6">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">About Chatcord</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        Chatcord is a platform designed to link connections like a cord,
                        and provide a space for sharing ideas. Whether you're here to post updates, interact
                        with others, or explore creative discussions, Chatcord offers an intuitive, engaging experience.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('posts.index') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 dark:hover:bg-blue-500">
                            View Posts
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 dark:hover:bg-green-500">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 dark:bg-gray-800 py-6 text-center">
            <p class="text-gray-600 dark:text-gray-400">
                © {{ date('Y') }} Chatcord. All rights reserved.
            </p>
        </footer>
    </div>
</body>
</html>
