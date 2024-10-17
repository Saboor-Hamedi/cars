<?php

use App\Http\Controllers\cars\CarController;
use App\Http\Controllers\FrontController;
use App\Livewire\Cars\CreateCars;
use App\Livewire\Cars\EditPost;
use App\Livewire\Users\Profile;
use App\Livewire\Vote\Vote;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/show/{car}', [FrontController::class, 'show'])->name('show-profile');
Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
Route::middleware('auth')->group(function () {
    Route::get('/cars', CreateCars::class)->name('cars.create-cars');
    Route::get('/users', Profile::class)->name('users.profile');
    Route::get('/vote', Vote::class)->name('vote.vote');

    Route::get('/cars/{id}/edit', EditPost::class)->name('cars.edit');
});

// contact
// Route::get('/contact-us', Contact::class)->name('contact-us.contact');
Route::get('/contact', function () {
    return view('contact.contact'); // Render the contact view
})->name('contact.contact');
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
