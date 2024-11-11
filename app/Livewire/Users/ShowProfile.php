<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class ShowProfile extends Component
{

    const CACHE_KEY = 'front-content-page-';
    const CACHE_DURATION = 600;
    const PAGINATION_SIZE = 3;

    public function toEdit($id)
    {
        // Validate the ID
        $this->validate([
            'id' => 'required|integer|exists:cars,id', // Ensure it's an integer and exists in cars table
        ]);

        $car = Car::findOrFail($id);

        // Check if the user has permission to update the car
        if (Gate::allows('update', $car)) {
            return redirect()->route('cars.edit', ['id' => $id]);
        }

        // Flash an error message and redirect back if unauthorized
        session()->flash('error', 'You do not have permission to edit this post.');
        return redirect()->back();
    }



    public function render()
    {

        $page = request()->get('page', 1);
        $cacheKey = self::CACHE_KEY . "{$page}";
        $latest = Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            return Car::with(['user.profile'])
                ->latest()
                ->paginate(self::PAGINATION_SIZE);
        });
        return view('livewire.users.show-profile', ['latest' => $latest]);
    }
}
