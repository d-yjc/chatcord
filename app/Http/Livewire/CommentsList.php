<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Post;

class CommentsList extends Component
{
    public $post;

    protected $listeners = ['commentAdded' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }   

    #[On('commentAdded')]
    public function refreshComments()
    {
        // This method will be called when the 'commentAdded' event is emitted.
        // To refresh the comments, simply re-render the component by triggering an update.
        // Livewire automatically re-renders the component when its state changes.
        // Here, we can set a dummy property to trigger reactivity.

        // Option 1: Reset a dummy property
        // $this->dummy = now();

        // Option 2: Re-fetch comments by updating a property (if comments are stored in a property)
        // In this case, since comments are fetched in render(), simply re-rendering is sufficient.

        // Trigger Livewire to re-render the component
        $this->render();
    }
    
    #[On('commentAdded')]
    public function render()
    {
        $comments = $this->post->comments()->with('attachment', 'chatUser')->get();

        return view('livewire.comments-list', compact('comments'));
    }
}

