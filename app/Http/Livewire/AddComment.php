<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Comment;

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
    
        $this->reset(['body', 'attachment']);
    
        $this->dispatch('commentAdded');
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}

