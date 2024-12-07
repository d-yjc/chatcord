@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Posts</h1>

    @foreach($posts as $post)
        <!-- Clickable Card -->
        <div 
            onclick="window.location='{{ route('posts.show', $post->id) }}';"
            class="cursor-pointer mb-2 p-4 border-b border-gray-200 rounded hover:bg-gray-100 transition transform hover:-translate-y-0.5">
            
            <!-- Username -->
            @if($post->chatUser && $post->chatUser->username)
                <p class="text-sm text-gray-500">
                    <a href="{{ route('profile.show', $post->chatUser->id) }}" class="hover:underline" onclick="event.stopPropagation();">
                        {{ '@' . $post->chatUser->username . " · " . $post->created_at->format('d M')}}
                    </a>
                </p>
            @endif

            <!-- Post Topic -->
            <h2 class="text-2xl font-bold text-blue-500 hover:underline mt-1">
                {{ $post->topic }}
            </h2>

            <!-- Attachment -->
            @if($post->attachment)
                <div class="mt-6">
                    <img 
                        src="{{ asset('storage/' . $post->attachment->file_path) }}" 
                        alt="Attachment" 
                        class="rounded w-full max-w-lg max-w-[175px] max-h-[175px] object-contain">
                </div>
            @endif
        </div>
    @endforeach

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
