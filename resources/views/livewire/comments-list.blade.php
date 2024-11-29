<!-- resources/views/livewire/comments-list.blade.php -->

<div>
    @if($comments->isEmpty())
        <p class="text-gray-500">No comments found.</p>
    @else
        @foreach($comments as $comment)
            <div class="mb-3 border p-2 rounded">
                @if($comment->chatUser)
                    <p>
                        <strong>
                            <a href="{{ route('profile.show', $comment->chatUser->id) }}">
                                {{ $comment->chatUser->username }}
                            </a>
                        </strong>
                        @ {{ $comment->created_at->format('Y-m-d H:i') }}
                    </p>
                @else
                    <p>By Unknown user (null) on {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                @endif
                <p>{{ $comment->body }}</p>

                @if($comment->attachment)
                    <div class="mt-2">
                        <img 
                        src="{{ asset('storage/' . $comment->attachment->file_path) }}" 
                        class="rounded-md shadow-md max-w-[200px] max-h-[200px] object-contain">
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>



