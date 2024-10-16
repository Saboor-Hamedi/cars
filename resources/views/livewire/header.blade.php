<div>
    <nav class="bg-white border-b border-gray-100">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 sm:flex sm:items-center sm:justify-start">
                    <div class="sm:ml-6">
                        <div class="flex space-x-4">

                            @auth
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                wire:navigate>Dashboard</x-nav-link>
                            @endauth

                            @guest
                            <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')"
                                wire:navigate>Home</x-nav-link>
                            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')" wire:navigate>
                                Login</x-nav-link>
                            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                                wire:navigate>Register</x-nav-link>
                            <x-nav-link href="{{ route('contact.contact') }}"
                                :active="request()->routeIs('contact.contact')" wire:navigate>Contact</x-nav-link>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</div>