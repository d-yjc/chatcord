<div>
    @foreach($comments as $comment)
        <div class="mb-3 border p-2 rounded">
            @if($comment->chatUser)
                <p>
                    <strong><a href="{{ route('profile.show', $comment->chatUser->id) }}">{{ $comment->chatUser->username }}</a></strong>
                    @ {{ $comment->created_at->format('Y-m-d H:i') }}
                </p>
            @else
                <p>By Unknown user (null) on {{ $comment->created_at->format('Y-m-d H:i') }}</p>
            @endif
            <p>{{ $comment->body }}</p>

            @if($comment->attachment)
            <p>File Path: {{ $comment->attachment->file_path ?? 'No attachment' }}</p>
            <p>Attachment: {{ json_encode($comment->attachment) }}</p>
            
            <img src="{{ asset('storage/' . $comment->attachment->file_path) }}" alt="Comment attachment">
            @endif
        </div>
    @endforeach
</div>
