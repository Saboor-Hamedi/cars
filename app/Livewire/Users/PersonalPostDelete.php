<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $imagePath = 'car_pics/' . $car->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $car->delete();
        $this->dispatch('refreshComponent', $car);
    }
    public function render()
    {

        return view('livewire.users.personal-post-delete');
    }
}
