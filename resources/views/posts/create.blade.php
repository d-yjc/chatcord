@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create Post</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <strong>Uh oh...</strong> There were some issues with your input:
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Topic Input -->
        <div>
            <label for="topic" class="block text-gray-700 font-medium mb-2">Topic:</label>
            <input type="text" name="topic" id="topic" value="{{ old('topic') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Body Input -->
        <div class="relative">
            <label for="body" class="block text-gray-700 font-medium mb-2">Body:</label>
            <textarea name="body" id="body" rows="5" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>

            <!-- Emoji Picker Button -->
            <button 
                type="button" 
                id="emojiPickerButton" 
                class="absolute bottom-4 right-4 bg-gray-100 text-gray-600 p-3 rounded hover:bg-gray-300 transition focus:outline-none">
                😊
            </button>

            <!-- Emoji Picker Menu -->
            <div id="emojiPickerMenu" 
                class="hidden absolute bottom-12 right-0 w-64 p-4 bg-white border border-gray-300 rounded-lg shadow-lg">
                <livewire:emoji-picker />
            </div>
        </div>

        <!-- File Upload -->
        <div>
            <label for="attachment" class="block text-gray-700 font-medium mb-2">Upload Attachment:</label>
            <input type="file" name="attachment" id="attachment" accept="image/jpeg,image/jpg,image/png"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit"
                class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Publish
            </button>
        </div>

    </form>
</div>
<!-- Since we're not using livewire here, we need to add the script within the blade itself.. -->
<script src="{{ asset('js/emoji-handler.js') }}"></script>
<script src="{{ asset('js/emoji-menu.js') }}"></script>
@endsection
