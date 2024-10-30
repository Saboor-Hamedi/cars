<nav class="fixed top-0 z-10 w-full bg-gray-800">
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" id="menu-toggle"
                    class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                <div class="flex items-center flex-shrink-0">
                    <img class="w-auto h-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex items-center space-x-4">
                        @auth
                            {{-- profile --}}
                            <x-custom-nav-link href="{{ route('users.profile') }}" :active="request()->routeIs('users.profile')">
                                <x-css-profile style="width: 20px;" />
                            </x-custom-nav-link>
                            {{-- dashboard --}}
                            <x-custom-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                <x-uni-create-dashboard style="width: 20px;" />
                            </x-custom-nav-link>

                        @endauth
                        @guest
                            <x-custom-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                                {{ __('Home') }}
                            </x-custom-nav-link>
                            <x-custom-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                                <x-untitledui-lock style="width: 20px;" />
                            </x-custom-nav-link>
                            <x-custom-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                <x-hugeicons-register style="width: 20px;" />
                            </x-custom-nav-link>
                        @endguest
                        <x-custom-nav-link href="{{ route('contact.contact') }}" :active="request()->routeIs('contact.contact')">
                            <x-hugeicons-contact style="width: 20px;" />
                        </x-custom-nav-link>

                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <button type="button"
                    class="relative p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button type="button"
                            class="relative flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleMenu()">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="">
                        </button>
                    </div>


                    <div class="absolute right-0 z-10 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                        id="user-menu">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-0">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-1">Settings</a>
                        @auth
                            <div>@livewire('voltlogout.logout')</div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" style="display: none;">

        @auth
            <x-custom-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" mobile="true">
                {{ __('Dashboard') }}
            </x-custom-nav-link>
        @endauth
        @guest
            <x-custom-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')" mobile="true">
                {{ __('Home') }}
            </x-custom-nav-link>
            <x-custom-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')" mobile="true">
                {{ __('Register') }}
            </x-custom-nav-link>
        @endguest
        <x-custom-nav-link href="{{ route('contact.contact') }}" :active="request()->routeIs('contact.contact')" mobile="true">
            {{ __('Contact') }}
        </x-custom-nav-link>
    </div>

    {{-- drop down --}}
    <script>
        function toggleMenu() {
            const menu = document.getElementById('user-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            } else {
                console.error('Menu element not found');
            }
        }
        window.onclick = function(event) {
            const menu = document.getElementById('user-menu');
            const button = document.getElementById('user-menu-button');
            if (menu && button && !button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        }
        // mobile version nav

        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            // Toggle the menu visibility on button click
            menuToggle.addEventListener('click', function() {
                const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;

                // Toggle the aria-expanded attribute
                menuToggle.setAttribute('aria-expanded', !isExpanded);

                // Toggle the display of the mobile menu
                if (isExpanded) {
                    mobileMenu.style.display = 'none'; // Close the menu
                } else {
                    mobileMenu.style.display = 'block'; // Open the menu
                }
            });
        });
    </script>

</nav>
