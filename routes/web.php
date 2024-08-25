<?php

use App\Http\Controllers\cars\CarController;
use App\Http\Controllers\FrontController;
use App\Livewire\Cars\CreateCars;

use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('welcome');

Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
Route::middleware('auth')->group(function () {
    Route::get('/cars', CreateCars::class)->name('cars.create-cars');
});
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
