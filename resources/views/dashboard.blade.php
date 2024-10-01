<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Home') }}
        </h2>
    </x-slot> --}}
    <div class="text-xl mt-2"></div>
    @livewire('hero')
    <div class="py-2">
        <div class="mx-auto">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('dashboard.content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
