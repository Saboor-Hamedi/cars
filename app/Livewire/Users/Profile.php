<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    public ?string $lastname = '';
    public ?string $birthday = '';
    public $photo;

    use WithFileUploads;
    public function mount()
    {
        // load data into inputs
        $this->lastname = auth()->user()->profile->lastname ?? '';
        $this->birthday = auth()->user()->profile->birthday ?? '';
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
        if ($profile) {
            if ($profile->isModified($data)) {
                $profile->update($data);
                session()->flash('message', "Profile Updated");
            } else {
                session()->flash('message', "Nothing changed");
            }
        } else {
            $user->profile()->create($data);
            session()->flash('message', "Profile Created");
        }
    }
    public function rules(): array
    {
        return [
            'lastname' => 'required|string|max:50',
            'birthday' => 'required|date',
        ];
    }


    public function render()
    {
        return view('livewire.users.profile')->layout('layouts.app');
    }
}
