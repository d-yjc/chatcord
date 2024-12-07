<div>
    @if($comments->isEmpty())
        <p class="text-gray-500">No comments found.</p>
    @else
        @foreach($comments as $comment)
            <div class="mb-3 border p-3 rounded">
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

                @if($editingCommentId === $comment->id)
                    <!-- Edit Form -->
                    <form wire:submit.prevent="saveEdit">
                        <textarea wire:model.defer="body" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none"
                            rows="3"></textarea>
                        @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <div class="mt-2">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                                Save
                            </button>
                            <button type="button" wire:click="resetEditing"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200">
                                Cancel
                            </button>
                        </div>
                    </form>
                @else
                    <!-- Comment Body -->
                    <div class="mt-2">
                    <p>{{ $comment->body }}</p>
                    </div>
                @endif

                <!-- Attachment -->
                @if($comment->attachment)
                    <div class="mt-2">
                        <img 
                            src="{{ asset('storage/' . $comment->attachment->file_path) }}"
                            class="rounded-md shadow-md max-w-[200px] max-h-[200px] object-contain">
                    </div>
                @endif

                <!-- Reaction Button -->
                <div class="mt-1">
                    @auth
                        <livewire:post-reactions :reactionable="$comment" />
                    @else
                        <p class="text-gray-500 text-xs">Log in to react to this comment.</p>
                    @endauth
                </div>

                <!-- Update/Delete Buttons -->
                <div class="mt-2 flex space-x-2">
                    @can('update', $comment)
                        <button wire:click="startEditing({{ $comment->id }})" class="text-blue-500 hover:underline">
                            Edit
                        </button>
                    @endcan
                    @can('delete', $comment)
                        <button wire:click="delete({{ $comment->id }})" class="text-red-500 hover:underline">
                            Delete
                        </button>
                    @endcan
                </div>
            </div>
        @endforeach
    @endif

    <!-- Flash Messages -->
    @if(session()->has('message'))
        <div class="text-green-600 mt-3">
            {{ session('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="text-red-600 mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>