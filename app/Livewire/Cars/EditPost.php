<?php
namespace App\Livewire\Cars;

use App\Models\Car;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Str;

class EditPost extends Component
{
    use WithFileUploads;

    public $car;
    public $name;
    public $color;
    public $year;
    public $image;
    public $description;
    protected $rules = [
        'name' => 'required|min:3|max:50',
        'color' => 'required|max:8',
        'year' => 'required|digits:4|integer|min:1900',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required|min:3|max:10000',
    ];

    public function mount($id)
    {
        $this->car = Car::find($id);
        $this->name = $this->car->name;
        $this->color = $this->car->color;
        $this->year = $this->car->year;
        $this->description = $this->car->description;
    }

    public function toEdit($id)
    {
        dd($id);
    }
    public function edit()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'color' => $this->color,
            'year' => $this->year,
            'description' => $this->description,
        ];

        if ($this->image) {
            // Handle image upload
            $originalName = pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedOriginalName = Str::slug($originalName, '_');
            $filename = Str::uuid() . '_' . $sanitizedOriginalName . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/car_pics', $filename);
            $data['image'] = 'car_pics/' . $filename;
        }

        $this->car->update($data);
        session()->flash('message', "'{$this->name}' successfully updated");
        // return $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.cars.edit')->layout('components.layout');
    }
}
