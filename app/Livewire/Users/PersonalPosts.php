<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PersonalPosts extends Component
{


    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        $cars = Car::with(['user.profile', 'user.votes'])->latest()->where('user_id', Auth::id())->paginate(3);
        return view('livewire.users.personal-posts', ['cars' => $cars]);
    }
}
