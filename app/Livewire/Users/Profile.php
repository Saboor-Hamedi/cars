<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{

    public ?string $lastname;
    public ?string $birthday;

    public $rules = [
        'lastname' => 'required|string|max:50',
        'birthday' => 'required|date',
    ];
    public function mount()
    {
        // load data into inputs
        $user = auth()->user();
        $this->lastname = $user->profile->lastname ?? '';
        $this->birthday = $user->profile->birthday ?? '';
    }


    public function update()
    {
        $this->validate();
        // check if profile exists; 

        $user = auth()->user();
        $profile = $user->profile;
        if ($profile) {
            $profile->update([
                'lastname' => $this->lastname,
                'birthday' => $this->birthday,
            ]);
        } else {
            $user->profile()->create([
                'lastname' => $this->lastname,
                'birthday' => $this->birthday,
            ]);
        }


        session()->flash('message', "Profile updated");
        $this->redirect('/users');
    }
    public function render()
    {
        return view('livewire.users.profile')->layout('layouts.app');
    }
}
