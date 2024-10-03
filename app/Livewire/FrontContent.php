<?php

namespace App\Livewire;
use App\Livewire\Logout;
use App\Models\Car;
use Livewire\Component;

class FrontContent extends Component
{
    public function render()
    {

        // $log = new Logout();
        // $log->logout();

        $cars = Car::with(['user.profile'])
            ->latest()
            ->paginate(3);
        return view('livewire.front-content', ['cars' => $cars]);
    }
}
