<?php

namespace App\Livewire\Cars;

use Livewire\Component;

class CreateCars extends Component
{


    public function render()
    {
        return view('livewire.cars.create-cars')->layout('layouts.app');
    }
}
