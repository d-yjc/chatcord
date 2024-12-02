@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <!-- About the Website Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">About the Website</h1>
            <p class="text-gray-700 mt-4">
                Welcome to Chatcord! Our platform enables users to connect like a cord! 
                Whether you're exploring posts, managing your profile, or interacting with others, Chatcord provides a 
                smooth and user-friendly experience powered by Laravel 11.x Sail.
            </p>
        </div>

        <!-- Separator -->
        <hr class="my-6 border-gray-200">

        <!-- Dashboard Content Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Welcome, {{ auth()->user()->username }}!</h2>
            <p class="text-gray-700">
                You're successfully logged in. Use the navigation bar to explore your profile, create posts, or view 
                discussions.
            </p>
        </div>

        <!-- Post & Profile Nav Section -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Quick Links</h3>
            <div class="flex gap-4">
                <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                    View Posts
                </a>
                <a href="{{ route('posts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">
                    Create Post
                </a>
                <a href="{{ route('profile.show', auth()->user()->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200">
                    View Profile
                </a>
            </div>
        </div>

        <!-- Separator -->
        <hr class="my-6 border-gray-200">

        <!-- Footer Section -->
        <div class="text-gray-600 text-sm text-center mt-6">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
@endsection
