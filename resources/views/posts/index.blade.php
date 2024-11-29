<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Posts</h1>

        @foreach($posts as $post)
            <div class="mb-6 p-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-blue-500 hover:underline">
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->topic }}</a>
                </h2>
                <p class="text-gray-700 mt-2">{{ Str::limit($post->body, 150) }}</p>
            </div>
        @endforeach

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
