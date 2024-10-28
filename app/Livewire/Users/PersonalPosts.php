<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalPosts extends Component
{

    public function render()
    {

        $cars = Car::with(['user.profile', 'user.votes'])->latest()->where('user_id', Auth::id())->paginate(3);

        return view('livewire.users.personal-posts', ['cars' => $cars]);
    }
}
