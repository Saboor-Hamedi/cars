<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Livewire\Component;

class ShowProfile extends Component
{

    public $car;
    public function mount(Car $car)
    {
        $this->car = $car;
    }
    public function render()
    {
        $latest = Car::with(['user.profile'])
            ->latest()
            ->paginate(3);
        return view('livewire.users.show-profile', ['latest' => $latest]);
    }
}
