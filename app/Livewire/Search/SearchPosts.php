<?php

namespace App\Livewire\Search;

use App\Models\Car;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchPosts extends Component
{
    public $query = '';
    public $cars = [];

    protected $rules = [
        'query' => 'required',
    ];

    public function updatedQuery()
    {
        $this->validate();
        $this->cars = Car::where('name', 'like', '%' . $this->query . '%')
            ->orWhere('description', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.search.search-posts');
    }
}
