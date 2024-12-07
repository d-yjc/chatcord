<!-- resources/views/livewire/profile-view.blade.php -->

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- User Information -->
     
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $user->username }}</h1>
        <p class="text-gray-600">Email: {{ $user->email }}</p>
        <p class="text-gray-600">Joined: {{ $user->created_at->format('d M Y') }}</p>

        <!-- Display User Roles -->
        <div class="mt-4">
            <span class="text-gray-600 font-medium">Roles:</span>
            @if($user->roles->isEmpty())
                <span class="text-gray-500">No roles assigned.</span>
            @else
                <ul class="flex flex-wrap mt-2 space-x-2">
                    @foreach($user->roles as $role)
                        <li class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $role->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

      <!-- Modal for Edit Profile -->
      @if ($isEditing)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                <button wire:click="toggleEditModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    &times;
                </button>
                <livewire:edit-profile :user="$user" />
            </div>
        </div>
    @endif
    
    <!-- Edit/Delete Buttons -->
    @can('update', $user)
        <div class="mt-4 mb-4">
            <button 
                wire:click="toggleEditModal" 
                class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-orange-400">
                Edit Profile
            </button>
        </div>
    @endcan

    @can('delete', $user)
        <div class="mt-4 mb-4">
            <button
                wire:click="confirmDelete" 
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                Delete Account
            </button>
        </div>
    @endcan

      <!-- Delete Confirmation Modal -->
      @if ($showDeleteConfirmation)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
                <p class="text-gray-600">Are you sure you want to delete this account? This action cannot be undone.</p>
                <div class="flex justify-end space-x-4 mt-6">
                    <button
                        wire:click="cancelDelete"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Cancel
                    </button>
                    <button
                        wire:click="deleteAccount"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    @endif

    <hr class="mb-6 border-gray-200">

    <!-- User's Posts -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Posts</h2>
        @if($posts->isEmpty())
            <p class="text-gray-500">No posts found.</p>
        @else
            <ul class="space-y-2">
                @foreach($posts as $post)
                    <li class="flex items-center justify-between bg-gray-100 p-4 rounded">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">{{ $post->topic }}</a>
                        <span class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <hr class="mb-6 border-gray-200">

    <!-- User's Comments -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Comments</h2>
        @if($comments->isEmpty())
            <p class="text-gray-500">No comments found.</p>
        @else
            <ul class="space-y-2">
                @foreach($comments as $comment)
                    <li class="bg-gray-100 p-4 rounded">
                        <p class="text-gray-700">
                            Commented on 
                            <a href="{{ route('posts.show', $comment->post->id) }}" class="text-blue-500 hover:underline">{{ $comment->post->topic }}</a>:
                            <br>
                            "{{ $comment->body }}"
                        </p>
                        <span class="text-sm text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="text-green-600 mt-4">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="text-red-600 mt-4">
            {{ session('error') }}
        </div>
    @endif
</div>

