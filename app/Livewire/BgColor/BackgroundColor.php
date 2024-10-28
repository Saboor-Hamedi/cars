<?php

namespace App\Livewire\BgColor;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BackgroundColor extends Component
{

    public ?string $backgroundColor = '';


    public function mount()
    {
        $this->backgroundColor = Auth::user()->profile->background_color ?? '#000000';
    }
    public function saveBackgroundColor()
    {
        $this->validate([
            'backgroundColor' => 'required|string|max:7|regex:/^#[a-fA-F0-9]{6}$/',
        ]);
        $profile = Auth::user()->profile;
        $profile->update(['background_color' => $this->backgroundColor]);
        session()->flash('message', 'Changed');
        $this->dispatch('backgroundColorUpdated', $this->backgroundColor);
    }

    public function getListeners()
    {
        return [
            'setBackgroundColor' => 'saveBackgroundColor',
        ];
    }


    public function render()
    {
        return view('livewire.bg-color.background-color');
    }
}