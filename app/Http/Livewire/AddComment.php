<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Mail\CommentNotification;
use App\Models\Comment;
use App\Models\Post;
use App\Services\OpenEmojiService;
use Illuminate\Support\Facades\Mail;

class AddComment extends Component
{
    use WithFileUploads;

    public $post;
    public $body = '';
    public $attachment;
    protected OpenEmojiService $emojiService;

    protected $rules = [
        'body' => 'required|string',
        'attachment' => 'nullable|file|max:1024',
    ];

    public function boot(OpenEmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    #[On('emojiSelected')]
    public function appendEmoji($emoji)
    {
        $this->body .= $emoji;
    }

    public function searchEmojis()
    {
        if (!empty($this->searchTerm)) {
            $this->emojis = $this->emojiService->searchEmojis($this->searchTerm);
        } else {
            $this->emojis = [];
        }
    }

    public function submit()
    {
        $this->validate();

        $comment = $this->post->comments()->create([ 
            'body' => $this->body,
            'chat_user_id' => auth()->id(),
        ]);

        if ($this->attachment) {
            $path = $this->attachment->store('attachments', 'public');
            $comment->attachment()->create([
                'file_path' => $path,
                'name' => $this->attachment->getClientOriginalName(),
            ]);
        }
        $this->sendCommentNotification($comment);
        $this->reset(['body', 'attachment']);
        $this->dispatch('commentAdded');
        session()->flash('message', 'Comment posted successfully!');
    }

    protected function sendCommentNotification(Comment $comment)
    {
        // Ensure the post owner exists and has an email
        if ($this->post->chatUser && $this->post->chatUser->email) {
            Mail::to($this->post->chatUser->email)->send(new CommentNotification($comment));
        }
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
    