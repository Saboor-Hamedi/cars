<?php

namespace App\Livewire\Cars;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
class Store extends Component
{
    use WithFileUploads;

    public $name;
    public $color;
    public $year;
    public $image;
    public $description;

    protected $rules = [
        'name' => 'required|min:3|max:50',
        'color' => 'required|max:8',
        'year' => 'required|digits:4|integer|min:1900',
        'image' => 'nullable|max:1024|image|mimes:image/*',
        'description' => 'required|min:3|max:1000',
    ];

    public function store()
    {
        $this->validate();
        $user = auth()->user();

        $data = [
            'name' => $this->name,
            'color' => $this->color,
            'year' => $this->year,
            'description' => $this->description,
        ];

        if ($this->image) {

            // Get original filename without extension
            $originalName = pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME);

            // Sanitize filename by replacing whitespace with underscores
            $sanitizedOriginalName = Str::slug($originalName, '_');

            // Create a unique filename using UUID, sanitized original name, and original extension
            $filename = Str::uuid() . '_' . $sanitizedOriginalName . '.' . $this->image->getClientOriginalExtension();

            // Save new photo
            $this->image->storeAs('public/car_pics', $filename);
            // Store the path relative to 'storage'
            $data['image'] = 'car_pics/' . $filename;
        }

        $user->car()->create($data);
        session()->flash('message', "'{$this->name}' successfully stored");
        $this->reset();
    }

    public function render()
    {
        return view('livewire.cars.store');
    }
}
