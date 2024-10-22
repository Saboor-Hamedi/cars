<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header class="fixed top-0 z-10 w-full bg-white border-b border-gray-100 shadow-md">
    <nav x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex h-16">
                <div class="flex items-center w-full p-4 ">
                    <!-- Logo -->
                    <div class="flex items-center mr-5 dashboard-logo">
                        <!-- Sidebar Button -->
                        <div class="openSidebar">
                            <button id="sidebar-open" onclick="openSidebar()" class="default-button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                                </svg>
                            </button>
                        </div>
                        {{-- dashboard-logo-name --}}
                        <div class="ml-4">
                            <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')"
                                wire:navigate>
                                {{__('Home')}}
                            </x-nav-link>
                        </div>

                    </div>
                </div>
                <div class="flex justify-end">
                    <button wire:click.prevent="logout" class="w-full text-start">
                        <svg class="w-5 h-5 text-red-200" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 12h14l-3 -3m0 6l3 -3" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </nav>
</header>