<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @foreach($posts as $post)
        <div>
            <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->topic }}</a></h2>
            <p>{{ Str::limit($post->body, 150) }}</p>
        </div>
    @endforeach

    {{ $posts->links() }} <!-- Pagination links -->
@endsection
