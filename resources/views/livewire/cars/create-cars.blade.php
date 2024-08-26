<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="px-4 py-4 mx-auto">
        <div class="max-w-md mx-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                {{-- @if (session()->has('message'))
                    <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                        {{ session('message') }}
                    </div>
                @endif --}}
                @livewire('cars.store')
                
            </div>
        </div>
    </div>

</div>
