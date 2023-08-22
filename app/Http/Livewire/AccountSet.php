<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AccountSet extends Component
{
    public $user_id;
    public $name;
    public $username;
    public $password;
    public $rePass;

    protected function rules()
    {
        return
        [
            'name' => 'string|max:255',
            'username' => 'unique:users,username',
            'password' => 'nullable|min:8|confirmed',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    public function updateUser()
    {
        $validatedData = $this->validate();

        User::where('id', $this->user_id)->update([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
        ]);
        session()->flash('message', 'Updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->username = '';
        $this->password = '';
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.account-set', compact('users'));
    }
}
