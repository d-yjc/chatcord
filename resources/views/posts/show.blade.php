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
                <img src="{{ asset('storage/' . $post->attachment->file_path) }}" alt="Attachment"
                    class="rounded-lg shadow-lg w-full max-w-lg">
            </div>
        @endif
        <div class="mt-4">
            @auth
                <livewire:post-reactions :reactionable="$post" />
            @else
                <p class="text-gray-500">Log in to react to this post.</p>
            @endauth
        </div>


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
                <a href="{{ route('posts.edit', $post->id) }}"
                    class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200">
                    Edit Post
                </a>
            </div>
        @endcan

        <!-- Delete -->
        @can('delete', $post)
            <div class="mt-4">
                <button onclick="showDeleteModal()"
                    class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                    Delete Post
                </button>
            </div>
        @endcan
    </div>

    <!-- Separator -->
    <hr class="my-6 border-gray-200">

    <!-- Add Comment Section -->
    <hr class="my-6 border-gray-200">
    <div>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Add a Comment</h3>
        <livewire:add-comment :post="$post" />
    </div>
    <!-- Comments Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Comments</h2>
        <livewire:comments-list :post="$post" />
    </div>

    <!-- Display Success Message -->
    @if (session()->has('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600">Are you sure you want to delete this post?</p>
            <div class="flex justify-end space-x-4 mt-6">
                <div>
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-500 text-white px-7 py-2 rounded-md hover:bg-gray-600">
                        Cancel
                    </button>
                </div>
                <div>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-7 py-2 rounded-md hover:bg-red-600">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection 

<script src="{{ asset('js/modal-handler.js') }}"></script>