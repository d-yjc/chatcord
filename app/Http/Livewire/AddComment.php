<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\CommentNotification;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Support\Facades\Mail;

class AddComment extends Component
{
    use WithFileUploads;

    public $post;
    public $body;
    public $attachment;

    protected $rules = [
        'body' => 'required|string',
        'attachment' => 'nullable|file|max:1024',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
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

        // Send email notification to the post author
        $postAuthor = $this->post->chatUser;

        if ($postAuthor && $postAuthor->email) {
            try {
                Mail::to($postAuthor->email)->send(new CommentNotification($comment));
            } catch (\Exception $e) {
                // Optionally, log the exception or handle the error
                \Log::error('Error sending comment notification email', [
                    'email' => $postAuthor->email,
                    'exception' => $e->getMessage(),
                ]);
                // Optionally, inform the user of the failure
                session()->flash('error', 'Failed to send notification email.');
            }
        }

        $this->reset(['body', 'attachment']);
        $this->dispatch('commentAdded');
        session()->flash('message', 'Comment posted successfully!');
    }

    

    public function render()
    {
        return view('livewire.add-comment');
    }
}

