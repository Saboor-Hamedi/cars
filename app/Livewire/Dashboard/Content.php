<?php

namespace App\Livewire\Dashboard;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;

class Content extends Component
{
    use WithPagination;

    public function render()
    {
        $cars = Car::with('user')->latest()->paginate(5);
        return view('livewire.dashboard.content', ['cars' => $cars]);
    }
}
