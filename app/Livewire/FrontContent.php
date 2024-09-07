<?php

namespace App\Livewire;

use App\Models\Car;
use App\Notifications\CarNotify;
use Livewire\Component;

class FrontContent extends Component
{
    public function render()
    {

        $cars = Car::with(['user.profile'])
            ->latest()
            ->paginate(3);
        return view('livewire.front-content', ['cars' => $cars]);
    }
}
