<x-layout>
    {{-- <x-slot:title>
       {{ __('Home') }}
    </x-slot> --}}
    {{-- <div class="mt-2 text-xl"></div> --}}
    @livewire('header')
    @livewire('hero')
    <div class="mx-auto">
        <div class="overflow-hidden">
            @livewire('front-content')
        </div>
    </div>
    @livewire('chat.chatbot')
    @livewire('footer')
</x-layout>
