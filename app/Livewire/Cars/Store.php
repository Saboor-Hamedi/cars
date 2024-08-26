<?php

namespace App\Livewire\Cars;

use Livewire\Component;

class Store extends Component
{

    public $name;

    public $color;

    public $year;

    public $description;


    protected $rules = [
        'name' => 'required|min:3|max:50',
        'color' => 'required|size:6', // Ensures the color has exactly 5 characters
        'year' => 'required|digits:4|integer|min:1900',
        'description' => 'required|min:3|max:1000',
    ];
    public function store()
    {

        $this->validate();
        auth()->user()->car()->create([
            'name' => $this->name,
            'color' => $this->color,
            'year' => $this->year,
            'description' => $this->description,
        ]);
        session()->flash('message', "'{$this->name}' successfully stored");
        $this->reset();
        // return $this->redirect('/cars');
    }
    public function render()
    {
        return view('livewire.cars.store');
    }
}
