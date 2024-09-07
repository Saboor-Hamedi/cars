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
    protected $listeners = ['refreshComponent' => '$refresh'];
    use WithFileUploads;
    public function mount()
    {
        // load data into inputs
        $this->lastname = auth()->user()->profile->lastname ?? '';
        $this->birthday = auth()->user()->profile->birthday ?? '';
        $this->photo = auth()->user()->profile->photo ?? null;
    }
    public function refreshSidebar()
    {
        $this->dispatchBrowserEvent('refresh-sidebar');
    }
    public function update()
    {
        $this->validate();
        $user = auth()->user();
        $data = [
            'lastname' => $this->lastname,
            'birthday' => $this->birthday,
        ];
        $profile = $user->profile;
        if ($this->photo instanceof TemporaryUploadedFile) {
            $this->validate([
                'photo' => 'image|mimes:jpeg,png,jpg',
            ]);
            // Delete old photo if it exists
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }

            // Save new photo
            $filename = Str::uuid() . '.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('public/profile_pics', $filename);

            // Store the path relative to 'storage'
            $data['photo'] = 'profile_pics/' . $filename;
        }

        if ($profile) {
            if ($profile->isModified($data)) {
                $profile->update($data);
                session()->flash('message', "Profile Updated");
            } else {
                session()->flash('message', "Nothing changed");
            }
        } else {
            $data['photo'] = $data['photo'] ?? null;
            $user->profile()->create($data);
            session()->flash('message', "Profile Created");
        }
    }
    public function rules(): array
    {
        return [
            'lastname' => 'required|string|max:50',
            'birthday' => 'required|date',
            'photo' => 'nullable|max:1024',
        ];
    }


    public function render()
    {
        return view('livewire.users.profile')->layout('layouts.app');
    }
}
