<x-layout>
    <x-slot:title>
       {{ __('Home') }}
    </x-slot>
    @livewire('header')
     <div class="py-2">
        <div class="mx-auto ">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('front-content')
                </div>
            </div>
        </div>
    </div>
</x-layout>