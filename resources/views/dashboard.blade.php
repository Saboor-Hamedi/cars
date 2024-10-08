<x-app-layout>
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
