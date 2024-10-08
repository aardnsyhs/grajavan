<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyAccountPage extends Component
{
    public $name;
    public $email;
    public User $user;

    public function mount()
    {
        $this->loadUserData();
    }

    protected function loadUserData(): void
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }


    public function updateAccount(): void
    {
        $this->validateAccountDetails();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->flashSuccessMessage();
    }


    protected function validateAccountDetails(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ]);
    }


    protected function flashSuccessMessage(): void
    {
        session()->flash('message', 'Your account has been updated successfully.');
    }


    public function render()
    {
        return view('livewire.my-account-page');
    }
}
