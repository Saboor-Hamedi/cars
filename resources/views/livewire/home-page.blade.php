<div>
    <h1>Hello world</h1>
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        
        @livewire('header')
        <header class="grid items-center grid-cols-2 gap-2 py-10 lg:grid-cols-3">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </header>
        <main>
            {{$slot}}
        </main>
    </div>
</div>
