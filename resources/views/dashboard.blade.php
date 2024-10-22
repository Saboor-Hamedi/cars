<x-app-layout>
    <div class="mt-2 text-xl"></div>
    <div class="mt-14">
        @livewire('hero')
    </div>
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