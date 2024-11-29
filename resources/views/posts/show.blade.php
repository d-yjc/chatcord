<!-- resources/views/posts/post-view.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <!-- Post Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $post->topic }}</h1>
            <p class="text-gray-700 mt-4">{{ $post->body }}</p>

            <!-- Attachment Section -->
            @if($post->attachment)
                <div class="mt-6">
                    <p class="text-gray-600">Attachment:</p>
                    <img src="{{ asset('storage/' . $post->attachment->file_path) }}" alt="Attachment" class="mt-2 rounded-md shadow-sm">
                </div>
            @endif

            <!-- Posted By Section -->
            <p class="mt-6 text-gray-600">
                Posted by: 
                <a href="{{ route('profile.show', $post->chatUser->id) }}" class="text-blue-500 hover:underline">
                    {{ $post->chatUser->username }}
                </a>
            </p>

            <!-- Update -->
            @can('update', $post)
                <div class="mt-4">
                    <a href="{{ route('posts.edit', $post->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200">
                        Edit Post
                    </a>
                </div>
            @endcan

            @cannot('update', $post)
                <div class="mt-4">
                    <p class="text-red-500">No updating allowed!</p>
                </div>
            @endcannot

            <!-- Delete -->
            @can('delete', $post)
                <div class="mt-4">
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                            Delete Post
                        </button>
                    </form>
                </div>
            @endcan

        </div>

        <!-- Separator -->
        <hr class="my-6 border-gray-200">

        <!-- Comments Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Comments</h2>
            @if($post->comments->isEmpty())
                <p class="text-gray-500">No comments found.</p>
            @else
                <livewire:comments-list :post="$post" />
            @endif
        </div>

        <!-- Add Comment Section -->
        <hr class="my-6 border-gray-200">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Add a Comment</h3>
            <livewire:add-comment :post="$post" />
        </div>
    </div>
@endsection
