<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    @if ($errors->any())
        <div>
            <strong>Uh oh...</strong> There were some issues with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="topic">Topic:</label><br>
            <input type="text" name="topic" id="topic" value="{{ old('topic') }}" required>
        </div>

        <div>
            <label for="body">Body:</label><br>
            <textarea name="body" id="body" required>{{ old('body') }}</textarea>
        </div>

        <div>
            <label for="attachment">Upload Attachment:</label><br>
            <input type="file" name="attachment" id="attachment" accept="image/jpeg,image/jpg,image/png">
        </div>

        <button type="submit">Create Post</button>
    </form>
@endsection
