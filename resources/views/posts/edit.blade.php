<!-- resources/views/posts/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Post</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Summary -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Topic Input -->
            <div>
                <label for="topic" class="block text-gray-700 font-medium mb-2">Topic:</label>
                <input 
                    type="text" 
                    id="topic" 
                    name="topic" 
                    value="{{ old('topic', $post->topic) }}" 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                    required
                >
                @error('topic')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Body Textarea -->
            <div>
                <label for="body" class="block text-gray-700 font-medium mb-2">Body:</label>
                <textarea 
                    id="body" 
                    name="body" 
                    rows="6" 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                    required
                >{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Attachment Input -->
            <div>
                <label for="attachment" class="block text-gray-700 font-medium mb-2">Upload Attachment:</label>
                <input 
                    type="file" 
                    id="attachment" 
                    name="attachment" 
                    class="w-full text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                >
                @error('attachment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <!-- Current Attachment Display -->
                @if($post->attachment)
                    <div class="mt-4">
                        <p class="text-gray-600">Current Attachment:</p>
                        <img src="{{ asset('storage/' . $post->attachment->file_path) }}" alt="Attachment" class="mt-2 rounded-md shadow-sm">
                        <p class="mt-2 text-sm text-gray-500">{{ $post->attachment->name }}</p>
                    </div>
                @endif
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="flex items-center space-x-4">
                <button 
                    type="submit" 
                    class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition duration-200"
                >
                    Update Post
                </button>
                <a 
                    href="{{ route('posts.show', $post->id) }}" 
                    class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition duration-200"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
