<?php

namespace App\Livewire;
use App\Models\Car;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class FrontContent extends Component
{
    public function toEdit($id)
    {

        $car = Car::findOrFail($id);
        if (Gate::allows('update', $car)) {
            return redirect()->route('cars.edit', ['id' => $id]);
        }
        abort(403, 'You do not have permission to edit this post.');
    }

    public function loadMore()
    {
        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        // $cars = Car::with(['user.profile'])
        //     ->latest()
        //     ->paginate(3);
        $page = request()->get('page', 1);
        $cacheKey = "front-content-page-{$page}";
        $cars = Cache::remember($cacheKey, 600, function () {
            return Car::with(['user.profile'])
                ->latest()
                ->paginate(3);
        });
        return view('livewire.front-content', ['cars' => $cars]);
    }
}
