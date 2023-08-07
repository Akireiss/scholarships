<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AccountSet extends Component
{
    public $userId;
    public $name;
    public $username;
    public $newPassw;
    public $rePass;

    protected $listeners = ['openModal'];

    public function openModal($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->newPassw = '';
        $this->rePass = '';

        $this->dispatchBrowserEvent('open-user-edit-modal');
    }

    public function updateUser()
    {
        $this->validate([
            'username' => 'required|unique:users,username,' . $this->userId,
            'newPassw' => 'nullable|min:8|confirmed',
        ]);

        $user = User::findOrFail($this->userId);

        // Update only if the fields are not empty
        if ($this->name !== null) {
            $user->name = $this->name;
        }
        
        if ($this->username !== null) {
            $user->username = $this->username;
        }
        
        if ($this->newPassw !== null) {
            $user->password = bcrypt($this->newPassw);
        }

        $user->save();

        $this->dispatchBrowserEvent('close-user-edit-modal');
    }
    public function render()
    {
        $users = User::all();
        return view('livewire.account-set', compact('users'));
    }
}
