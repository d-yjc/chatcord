@extends('layouts.app')

@section('content')
    <h1>{{ $post->topic }}</h1>

    <p>{{ $post->body }}</p>

    @if($post->attachment)
        <p>Attachment:</p>
        <!--<a href="{{ asset('storage/' . $post->attachment->file_path) }}" target="_blank">Download Attachment</a>-->
        <img src="{{ asset('storage/' . $post->attachment->file_path) }}" alt="Attachment">
    @endif
    <p>Posted by: <a href="{{ route('profile.show', $post->chatUser->id) }}">{{ $post->chatUser->username }}</a></p>
    
    <hr>

    <h2>Comments</h2>       

    @foreach($post->comments as $comment)
        <div>
            @if($comment->chatUser)
                <p><a href="{{ route('profile.show', $comment->chatUser->id) }}">{{ $comment->chatUser->username }}</a> @ {{ $comment->created_at->format('Y-m-d H:i') }}</p>
            @else
                <p>By Unknown user (null) on {{  $comment->created_at->format('Y-m-d H:i') }}</p>
            @endif
            <p>{{ $comment->body }}</p>

            @if($comment->attachment)
                <img src="{{ asset('storage/' . $comment->attachment->file_path) }}" alt="Comment attachment">
            @endif
        </div>
    @endforeach

    <hr>

    @auth
        <div class="mb-4">
            <a href="{{ route('profile.my') }}" class="btn btn-primary">View My Profile</a>
        </div>

        <h3>Add a Comment</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
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

            <div class="form-group">
                <label for="body">Comment:</label><br>
                <textarea name="body" id="body" class="form-control" required>{{ old('body') }}</textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Upload Attachment:</label><br>
                <input type="file" name="attachment" id="attachment" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to add a comment.</p>
    @endauth
@endsection
