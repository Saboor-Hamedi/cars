<?php

namespace App\Livewire\Password;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected $rules = [
        'current_password' => 'required',
        'new_password' => 'required|confirmed|min:8',
    ];

    public function changePassword()
    {
        // Validate the input fields
        $this->validate();

        // Check if the current password is correct
        if (Hash::needsRehash(Auth::user()->password)) {
            throw ValidationException::withMessages(['current_password' => 'Your password is not hashed using Bcrypt. Please contact support.']);
        } else if (!Hash::check($this->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages(['current_password' => 'Incorrect current password.']);
        }




        // Update the user's password
        Auth::user()->update(['password' => Hash::make($this->new_password)]);

        // Flash success message
        session()->flash('message', 'Your password has been changed successfully.');
    }

    public function render()
    {
        return view('livewire.password.change-password')->layout('layouts.app');
    }
}