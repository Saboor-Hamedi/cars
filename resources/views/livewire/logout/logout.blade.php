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
    <a wire:click="logout" class="flex px-2 py-2 text-sm text-gray-700 cursor-pointer" wire:navigate>
        <x-antdesign-logout-o style="width: 15px; color:red;" />
        <span class="ml-2">{{ __('Log Out') }}</span>
    </a>
</div>
