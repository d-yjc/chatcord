<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatUser;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $username;
    public $email;

    public function mount(ChatUser $user)
    {
        $this->user = $user;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        if (!Auth::user()->can('update', $this->user)) {
            session()->flash('error', 'You do not have permission to update this profile!');
            return;
        }

        $this->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $this->user->update([
            'username' => $this->username,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Profile updated successfully!');
        $this->dispatch('closeEditModal'); // Notify parent to close modal
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
