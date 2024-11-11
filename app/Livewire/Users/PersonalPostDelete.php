<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalPostDelete extends Component
{

    public $isDelete = false;
    public $carId;
    public function mount($carId)
    {
        $this->carId = $carId;
    }

    public function delete()
    {

        $this->isDelete = true;
        $car = Car::findOrFail($this->carId);
        $this->authorize('delete', $car);
        $car->delete();
        $this->dispatch('refreshComponent', $car);
    }
    public function render()
    {

        return view('livewire.users.personal-post-delete');
    }
}
