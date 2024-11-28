<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class CommentsList extends Component
{
    public $post;

    protected $listeners = ['commentAdded' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $comments = $this->post->comments()->with('attachment', 'chatUser')->get();

        return view('livewire.comments-list', compact('comments'));
    }
}

