<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\ChatUser;
use App\Models\Role;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $username;
    public $email;

    public $roles = [];
    public $availableRoles;

    public function mount(ChatUser $user)
    {
        $this->user = $user;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->availableRoles = Role::whereNotIn('id', [1])->get();
        $this->roles = $this->user->roles->pluck('id')->toArray();
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
            'roles' => 'array|exists:roles,id',
        ]);

        $this->user->update([
            'username' => $this->username,
            'email' => $this->email,
        ]);

        //Role assignment
        if (Auth::user()->hasExistingRole('admin')) {
            $filteredRoles = array_filter($this->roles, function ($roleId) {
                $role = Role::find($roleId);
                return $role && Gate::allows('update', $role);
            });

            $this->user->roles()->sync($filteredRoles);
        }

        session()->flash('message', 'Profile updated successfully!');
        $this->dispatch('closeEditModal'); 
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
