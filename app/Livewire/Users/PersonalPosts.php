<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PersonalPosts extends Component
{

    const CACHE_KEY = 'profile-content-page-';
    const CACHE_DURATION = 600;
    const PAGINATION_SIZE = 3;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        $page = request()->get('page', 1);
        $cacheKey = self::CACHE_KEY . "{$page}";
        $cars = Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            return Car::with(['user.profile'])
                ->latest()
                ->where('user_id', Auth::id())
                ->paginate(self::PAGINATION_SIZE);
        });
        // $cars = Car::with(['user.profile'])->latest()->where('user_id', Auth::id())->paginate(3);
        return view('livewire.users.personal-posts', ['cars' => $cars]);
    }
}
