<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>{{ $post->topic }}</h1>

    <p>{{ $post->body }}</p>

    @if($post->attachment)
        <p>Attachment:</p>
        <a href="{{ asset('storage/' . $post->attachment->file_path) }}" target="_blank">Download Attachment</a>
    @endif

    <hr>

    <h2>Comments</h2>       

    @foreach($post->comments as $comment)
        <div>
            <p>{{ $comment->body }}</p>

            @if($comment->attachment)
                <p>Attachment:</p>
                <a href="{{ asset('storage/' . $comment->attachment->file_path) }}" target="_blank">Download Attachment</a>
            @endif
    
            <p>By {{ $comment->chatUser->username }} on {{ $comment->created_at->format('Y-m-d H:i') }}</p>
        </div>
    @endforeach

    <hr>

    @auth
        <h3>Add a Comment</h3>

        @if ($errors->any())
            <div>
                <strong>Uh oh!</strong> There were some issues with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="body">Comment:</label><br>
                <textarea name="body" id="body" required>{{ old('body') }}</textarea>
            </div>

            <div>
                <label for="attachment">Upload Attachment:</label><br>
                <input type="file" name="attachment" id="attachment">
            </div>

            <button type="submit">Post Comment</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to add a comment.</p>
    @endauth
@endsection
