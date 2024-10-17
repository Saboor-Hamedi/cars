<?php

use Livewire\Volt\Component;
use App\Livewire\Actions\Logout;
new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <button wire:click="logout" class="w-full text-start">
        <x-dropdown-link>
            {{ __('Log Out') }}
        </x-dropdown-link>
    </button>
</div>