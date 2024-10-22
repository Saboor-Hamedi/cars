<div>
    <header class="fixed top-0 z-10 w-full bg-white border-b border-gray-100 shadow-md">
        <nav>
            <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="flex-1 sm:flex sm:items-center sm:justify-start">
                        <div class="sm:ml-6">
                            <div class="flex space-x-4">

                                @auth
                                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                    wire:navigate>{{__('Dashboard')}}</x-nav-link>
                                @endauth

                                @guest
                                <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')"
                                    wire:navigate>{{__('Home')}}</x-nav-link>
                                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                                    wire:navigate>
                                    {{__('Login')}}
                                </x-nav-link>
                                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                                    wire:navigate>{{__('Register')}}</x-nav-link>
                                @endguest
                                <x-nav-link href="{{ route('contact.contact') }}"
                                    :active="request()->routeIs('contact.contact')" wire:navigate>{{__('Contact')}}
                                </x-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>


</div>