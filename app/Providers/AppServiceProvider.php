<?php

namespace App\Providers;

use App\Livewire\Cars\Store;
use App\Livewire\Logout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        Livewire::component('logout', Logout::class);
        Livewire::component('cars/store', Store::class);

        $this->timezone();
        Blade::component('app-layout', \App\View\Components\AppLayout::class);
        // Livewire::setScriptRoute(callback: function ($handle) {
        //     return Route::get('/vendor/livewire/livewire.js', $handle);
        // });

    }

    private function timezone()
    {
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Jakarta');
    }
}
