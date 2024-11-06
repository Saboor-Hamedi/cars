  <div class="fixed top-0  w-full bg-gray-800 z-10">
      <ul class="flex items-center text-xs font-medium text-center text-white dark:text-gray-400">
          <li>
              <x-profile-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                  <x-untitledui-home style="width: 15px;" class="mr-1" />
                  {{ __('Feed') }}
              </x-profile-nav-link>
          </li>
          <li>
              <x-profile-nav-link href="{{ route('users.profile') }}" :active="request()->routeIs('users.profile')">
                  <x-css-profile style="width: 15px;" class="mr-1" />
                  {{ __('Profile') }}
              </x-profile-nav-link>
          </li>
          <li>
              <x-profile-nav-link href="{{ route('users.personal-info') }}" :active="request()->routeIs('users.personal-info')">
                  <x-monoicon-settings style="width: 15px;" class="mr-1" />
                  {{ __('Dashboard') }}
              </x-profile-nav-link>
          </li>

          <ul class="flex items-center justify-end w-full h-12 ">
              <li class="transition duration-300 ease-in-out">
                  @livewire('logout')
              </li>
          </ul>
      </ul>
  </div>
