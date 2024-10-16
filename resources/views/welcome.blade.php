<x-layout>
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