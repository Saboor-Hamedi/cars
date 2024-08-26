<?php

namespace App\Livewire\Cars;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Form;

class Store extends Component
{

    public $name;

    public $color;

    public $year;

    public $description;


    protected $rules = [
        'name' => 'required|min:3|max:50',
        'color' => 'required|min:3|max:50',
        'year' => 'required|min:3|max:50',
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
