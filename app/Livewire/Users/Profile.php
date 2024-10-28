<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    public $photo = '';
    public $lastname = '';
    public $photoPath = '';
    public ?string $bgColor = '';

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'backgroundColorUpdated' => 'updateColor'
    ];
    use WithFileUploads;
    public function mount()
    {
        $user = Auth::user();
        // dd($user->profile->lastname);
        $profile = $user->profile;
        $this->lastname = $profile->lastname ?? null;
        $this->photoPath = $profile->photo ?? null;
        $this->bgColor = $profile->background_color ?? '#000000';
    }

    public function updateColor($color)
    {
        $this->bgColor = $color;
    }

    public function render()
    {
        return view('livewire.users.profile')->layout('components.layout');
        // ->layout('layouts.app')
    }
}
