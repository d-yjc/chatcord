<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostView extends Component
{
    public $post;

    public function mount(Post $post) 
    {
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.post-view');
    }
}
