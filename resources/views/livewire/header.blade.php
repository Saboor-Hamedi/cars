<div>
    <nav class="bg-white border-b border-gray-100">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 sm:flex sm:items-center sm:justify-start">
                    <div class="sm:ml-6">
                        <div class="flex space-x-4">
                            @auth
                                <a class="default-button" href="{{ route('dashboard') }}"
                                    :active="request() - > routeIs('dashboard')">Dashboard</a>
                            @endauth
                            @guest
                                <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">Home</x-nav-link>
                                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Login</x-nav-link>
                                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-nav-link>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</div>
