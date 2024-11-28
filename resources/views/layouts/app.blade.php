<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Application</title>
    
    <!-- Vite Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Home Link -->
            <a href="{{ route('home') }}" class="text-xl font-bold hover:text-gray-400">Home</a>
            <a href="{{ route('posts.index') }}" class="text-xl font-bold hover:text-gray-400">Posts</a>
            
            <div>
                @auth
                    <!-- Create post Link -->
                    <a href="{{ route('posts.create') }}" class="mr-4 hover:text-gray-400">Create Post</a>
                    <!-- Profile Link -->
                    <a href="{{ route('profile.show', auth()->user()->id) }}" class="mr-4 hover:text-gray-400">Profile</a>
                    
                    <!-- Logout Link -->
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
