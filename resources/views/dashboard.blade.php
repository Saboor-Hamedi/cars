<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Home') }}
        </h2>
    </x-slot> --}}
    <div class="mt-2 text-xl"></div>
    @livewire('hero')
    <div class="py-2">
        <div class="mx-auto">
            <div class="overflow-hidden">
                <div class="text-gray-900 ">
                    @livewire('dashboard.content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
