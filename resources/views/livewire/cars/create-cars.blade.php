<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('New Car') }}
        </h2>
    </x-slot>
    <div class="px-4 py-4 mx-auto">
        <div class="max-w-md mx-auto rounded-lg shadow-md bg-white-300">
            <div class="p-4 text-gray-900">
                @livewire('cars.store')
            </div>
        </div>
    </div>

</div>
