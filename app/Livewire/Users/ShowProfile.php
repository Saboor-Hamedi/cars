<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ShowProfile extends Component
{


    public function toEdit($id)
    {

        $car = Car::findOrFail($id);
        if (Gate::allows('update', $car)) {
            return redirect()->route('cars.edit', ['id' => $id]);
        }
        abort(403, 'You do not have permission to edit this post.');
    }


    public function render()
    {
        $latest = Car::with(['user.profile'])
            ->latest()
            ->paginate(3);
        return view('livewire.users.show-profile', ['latest' => $latest]);
    }
}
