<?php

namespace App\Providers;

use App\Livewire\Logout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        // Livewire::component('logout', Logout::class);
        // Blade::component('app-layout', \App\View\Components\AppLayout::class);
    }
}
