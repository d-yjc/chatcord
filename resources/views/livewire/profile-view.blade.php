<!-- resources/views/livewire/profile-view.blade.php -->
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $user->username }}</h1>
        <p class="text-gray-600">Email: {{ $user->email }}</p>
        <p class="text-gray-600">Joined: {{ $user->created_at->format('d M Y') }}</p>
    </div>

    <hr class="mb-6">

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

    <hr class="mb-6">

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
</div>
