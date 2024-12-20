@props(['active' => false, 'mobile' => false])
<!-- Add a mobile prop -->

<a class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md p-2 text-sm font-medium {{ $mobile ? 'block text-base' : '' }}"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }} wire:navigate>
    {{ $slot }}
</a>
