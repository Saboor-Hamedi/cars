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
        $cars = Car::with(['user.profile'])->latest()->where('user_id', auth()->user()->id)->paginate(3);
        return view('livewire.dashboard.content', ['cars' => $cars]);
    }
}
