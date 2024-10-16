<?php

namespace App\Livewire\Markdown;

use App\Models\Car;
use Livewire\Component;

class Markdown extends Component
{
    public $content; // Use this for the markdown content




    public function render()
    {
        return view('livewire.markdown.markdown');
    }
}
