<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Profile extends Component
{
    public ?string $lastname = '';
    public ?string $birthday = '';
    public $photo;
    public $photoPath;
    protected $listeners = ['refreshComponent' => '$refresh'];
    use WithFileUploads;
    public function mount()
    {
        $user = auth()->user();
        $profile = $user->profile;
        // load data into inputs
        $this->lastname = $profile->lastname ?? '';
        $this->birthday = $profile->birthday ?? '';
        $this->photoPath = $profile->photo ?? null;
    }
    public function refreshSidebar()
    {
        $this->dispatchBrowserEvent('refresh-sidebar');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,webp,avif,gif|max:1024',
        ]);
    }
    public function update()
    {
        $this->validate();
        $user = auth()->user();
        $profile = $user->profile;

        $data = [
            'lastname' => $this->lastname,
            'birthday' => $this->birthday,
        ];

        if ($this->photo instanceof TemporaryUploadedFile) {
            $data['photo'] = $this->uploadPhoto($profile->photo);
        }

        if ($profile) {
            $this->updateProfile($profile, $data);
        } else {
            $this->createProfile($user, $data);
        }

        $this->reset('photo');
        $this->photoPath = $data['photo'] ?? $this->photoPath;

    }

    public function uploadPhoto(?string $existingPhoto): string
    {
        // Delete old photo if it exists
        if ($existingPhoto) {
            Storage::disk('public')->delete($existingPhoto);
        }

        // save photo
        $filename = Str::uuid() . '.' . $this->photo->getClientOriginalExtension();
        $this->photo->storeAs('public/profile_pics', $filename);
        return 'profile_pics/' . $filename;
    }

    public function updateProfile($profile, array $data)
    {
        if ($profile->isModified($data)) {
            $profile->update($data);
            session()->flash('message', 'Profile updated');

        } else {
            session()->flash('message', 'Nothing changed');
        }
    }
    public function createProfile($user, array $data)
    {
        $user->profile()->create($data);
        session()->flash('message', 'Profile created');
    }
    public function rules(): array
    {
        return [
            'lastname' => 'required|string|max:50',
            'birthday' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,gif|max:1024',
        ];
    }


    public function render()
    {
        return view('livewire.users.profile')->layout('components.layout');
        // ->layout('layouts.app')
    }
}
