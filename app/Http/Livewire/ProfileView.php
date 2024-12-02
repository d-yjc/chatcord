<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChatUser;
use Illuminate\Support\Facades\Auth;

class ProfileView extends Component
{
    public $user;
    public $isEditing = false;
    public $showDeleteConfirmation = false; // New property to manage the confirmation modal

    protected $listeners = ['closeEditModal'];

    public function mount(ChatUser $user)
    {
        $this->user = $user;
    }

    public function toggleEditModal()
    {
        $this->isEditing = !$this->isEditing;
    }

    public function confirmDelete()
    {
        $this->showDeleteConfirmation = true; // Show the confirmation modal
    }

    public function cancelDelete()
    {
        $this->showDeleteConfirmation = false; // Hide the confirmation modal
    }

    public function deleteAccount()
    {
        if (!Auth::user()->can('delete', $this->user)) {
            session()->flash('error', 'You do not have permission to delete this account!');
            $this->cancelDelete();
            return;
        }

        $this->user->delete();
        session()->flash('message', 'Account deleted successfully!');
        $this->cancelDelete();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.profile-view', [
            'posts' => $this->user->posts()->latest()->get(),
            'comments' => $this->user->comments()->latest()->get(),
        ]);
    }
}
