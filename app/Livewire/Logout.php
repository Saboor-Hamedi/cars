<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Logout extends Component
{

    // custom logout 

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
    public function render()
    {
        return view('livewire.logout');
    }
}
