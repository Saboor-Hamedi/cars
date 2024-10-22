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
    {{-- <button wire:click.prevent="logout" class="w-full text-start">
        {{ __('Log Out') }}
    </button> --}}
</div>