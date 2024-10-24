<x-layout>
    @livewire('header')
    <div class="mt-14">
        @livewire('hero')
    </div>
    <div class="mx-auto">
        <div class="overflow-hidden">
            @livewire('front-content')
        </div>
    </div>
    @livewire('chat.chatbot')
    @livewire('footer')
</x-layout>
