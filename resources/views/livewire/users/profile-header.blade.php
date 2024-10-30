  <div class="border-b border-gray-200 h-30 dark:border-gray-700">
      <ul class="flex items-center text-xs font-medium text-center text-gray-500 dark:text-gray-400">
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

          <ul class="flex items-center justify-end w-full h-12">
              <li class="px-4 py-2 transition duration-300 ease-in-out hover:bg-gray-500">
                  @livewire('logout')
              </li>
          </ul>


      </ul>
  </div>
