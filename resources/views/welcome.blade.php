@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">About Chatcord</h2>
        <p class="text-gray-700 mb-6">
            Chatcord is a platform designed to link connections like a cord,
            and provide a space for sharing ideas. Whether you're here to post updates, interact
            with others, or explore creative discussions, Chatcord offers an intuitive, engaging experience.
        </p>
        <div class="flex space-x-4">
            <a href="{{ route('posts.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                View Posts
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Get Started
            </a>
        </div>
    </div>
</div>
@endsection
