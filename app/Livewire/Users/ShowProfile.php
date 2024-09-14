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
        return view('livewire.users.show-profile');
    }
}
