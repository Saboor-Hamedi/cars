<?php

namespace App\Livewire\Dashboard;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Content extends Component
{
    use WithPagination;

    public function toEdit($id)
    {
        return redirect()->route('cars.edit', ['id' => $id]);
    }

    public function render()
    {
        $cars = Car::with(['user.profile'])->latest()->where('user_id', Auth::id())->paginate(3);
        return view('livewire.dashboard.content', ['cars' => $cars]);
    }
}
