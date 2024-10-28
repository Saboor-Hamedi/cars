  <div class="border-b border-gray-200 dark:border-gray-700">
      <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
          <li class="me-2">
              <x-profile-nav-link href="{{ route('users.profile') }}" :active="request()->routeIs('users.profile')">
                  <x-css-profile style="width: 18px;" class="mr-1" />
                  Profile
              </x-profile-nav-link>
          </li>
          <li class="me-2">
              <x-profile-nav-link href="{{ route('users.personal-info') }}" :active="request()->routeIs('users.personal-info')">
                  <x-monoicon-settings style="width: 18px;" class="mr-1" />
                  Dashboard
              </x-profile-nav-link>

          </li>

      </ul>
  </div>
