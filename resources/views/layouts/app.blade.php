<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>My Messaging Board</title>
    <!-- Include CSS files or frameworks here -->
</head>
<body>
    <nav>   
        <!-- Navigation links -->
        <a href="{{ route('posts.index') }}">Home</a>
        @auth
            <a href="{{ route('posts.create') }}">Create Post</a>
            <span>Welcome, {{ auth()->user()->username }}</span>
            <a href="{{ route('logout') }}">Logout</a>  
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <div class="container">
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Include JS files or frameworks here -->
</body>
</html>
