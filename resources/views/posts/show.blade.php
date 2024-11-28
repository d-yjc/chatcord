@extends('layouts.app')

@section('content')
    <h1>{{ $post->topic }}</h1>

    <p>{{ $post->body }}</p>

    @if($post->attachment)
        <p>Attachment:</p>
        <img src="{{ asset('storage/' . $post->attachment->file_path) }}" alt="Attachment">
    @endif
    <p>Posted by: <a href="{{ route('profile.show', $post->chatUser->id) }}">{{ $post->chatUser->username }}</a></p>

    @can('update', $post)
        <div class="mt-2">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit Post</a>
        </div>
    @endcan

    <hr>

    <h2>Comments</h2>       
    <livewire:comments-list :post="$post" />

    <hr>

    <h3>Add a Comment</h3>
    <livewire:add-comment :post="$post" />
@endsection
