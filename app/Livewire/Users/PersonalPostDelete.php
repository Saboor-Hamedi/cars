<?php

namespace App\Livewire\Users;

use App\Models\Car;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PersonalPostDelete extends Component
{

    public $isDelete = false;
    public $carId;
    public function mount($carId)
    {
        $this->carId = $carId;
    }

    public function delete()
    {
        $this->isDelete = true;
        $car = Car::findOrFail($this->carId);
        $this->authorize('delete', $car);
        try {
            $imagePath = $car->image; // Ensure this is the correct relative path
            if (!empty($imagePath)) {
                if (Storage::disk('public')->exists($imagePath)) {
                    // Log::info('File exists. Deleting image at path: ' . $imagePath);
                    Storage::disk('public')->delete($imagePath);
                } else {
                    Log::warning('File does not exist, proceeding to delete car: ' . $imagePath);
                }
            } else {
                Log::info('No image path provided, proceeding to delete car with ID: ' . $this->carId);
            }

            $car->delete();
            $this->dispatch('refreshComponent', $car);
        } catch (Exception $e) {
            Log::error('Error deleting car or image: ' . $e->getMessage());
        }
    }
    public function render()
    {

        return view('livewire.users.personal-post-delete');
    }
}
