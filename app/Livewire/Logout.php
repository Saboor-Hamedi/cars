<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Logout extends Component
{

    // custom logout

    public function logout()
    {
        // Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.logout');
    }
}
