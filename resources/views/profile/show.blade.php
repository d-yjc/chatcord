@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->username }}'s Profile</h1>

    <h3>Roles:</h3>
    <ul>
        @foreach($user->roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>

    <h2>Posts</h2>
    <ul>
        @foreach($user->posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                <p>{{ $post->topic }}</p>
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
