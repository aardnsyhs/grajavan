<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyAccountPage extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $image;
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

        if ($this->image) {
            if ($this->user->image) {
                $this->deleteOldImage();
            }

            $imagePath = $this->image->store('profile-pictures', 'public');

            $this->user->image = $imagePath;
        }

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->user->image
        ]);

        $this->flashSuccessMessage();
    }

    protected function validateAccountDetails(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'image' => 'nullable|image|max:4096',
        ]);
    }

    protected function deleteOldImage(): void
    {
        if ($this->user->image && Storage::disk('public')->exists($this->user->image)) {
            Storage::disk('public')->delete($this->user->image);
        }
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
