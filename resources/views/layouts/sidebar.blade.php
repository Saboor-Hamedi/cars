<div >
    {{-- @livewire('sidebar') on app.blade.php --}}
    <div class="close-sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6" onclick="closeSidebar()">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>
    <ul>
        <li>
            <x-nav-link :href="route('cars.create-cars')" :active="request()->routeIs('cars.create-cars')" wire:navigate>
                {{ __('Create') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

            </x-nav-link>
        </li>
        <li>
            @livewire('logout')
        </li>
    </ul>
</div>
