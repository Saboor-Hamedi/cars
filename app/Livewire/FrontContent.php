<?php

namespace App\Livewire;
use App\Models\Car;
use Livewire\Component;

class FrontContent extends Component
{
    public function toEdit($id)
    {
        return redirect()->route('cars.edit', ['id' => $id]);
    }

    public function render()
    {
        $cars = Car::with(['user.profile'])
            ->latest()
            ->paginate(3);
        return view('livewire.front-content', ['cars' => $cars]);
    }



}
