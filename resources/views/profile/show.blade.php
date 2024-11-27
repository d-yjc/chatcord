@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s Profile</h1>

    <h2>Posts</h2>
    <ul>
        @foreach($user->posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                <p>{{ $post->body }}</p>
            </li>
        @endforeach
    </ul>

    <h2>Comments</h2>
    <ul>
        @foreach($user->comments as $comment)
            <li>
                <p>{{ $comment->body }}</p>
                <p>On post: <a href="{{ route('posts.show', $comment->post->id) }}">{{ $comment->post->title }}</a></p>
            </li>
        @endforeach
    </ul>
</div>
@endsection
