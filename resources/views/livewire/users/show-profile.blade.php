<x-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @livewire('header')

    <div class="max-w-md mx-auto overflow-hidden bg-gray-500 rounded-md shadow-lg md:max-w-3xl">
        <div class="flex flex-col justify-between sm:flex-row md:flex md:flex-row-reverse">
            <div class="sm:w-1/2 md:w-1/2">
                <img src="{{ asset('storage/' . $car->user->profile->photo) }}" class="w-full h-full object-fit">
            </div>
            <div class="px-3 sm:w-1/2 md:w-1/2">
                <a href="" class="block mt-1 text-lg font-bold leading-tight text-gray-800">
                    {{ $car->name }}
                </a>
                <p class="mt-2 text-gray-200">{{ $car->description }}</p>
            </div>
        </div>
        @livewire('vote.vote', ['car' => $car])
    </div>

</x-layout>
