<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChatUser;

class ProfileView extends Component
{
    public $user;

    /**
     * Mount the component with the User instance.
     *
     * @param  \App\Models\ChatUser  $user
     * @return void
     */
    public function mount(ChatUser $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profile-view', [
            'posts' => $this->user->posts()->latest()->get(),
            'comments' => $this->user->comments()->latest()->get(),
        ]);
    }
}
