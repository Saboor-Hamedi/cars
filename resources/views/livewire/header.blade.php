<div>
    <nav class="bg-gray-800">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                {{-- <div class="flex items-center flex-shrink-0">
                    <img class="w-auto h-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div> --}}
                <div class="flex-1 sm:flex sm:items-center sm:justify-start">
                    <div class="sm:ml-6">
                        <div class="flex space-x-4">
                            @if (Route::has('login'))
                                <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">Home</x-nav-link>
                                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Login</x-nav-link>
                                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-nav-link>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
