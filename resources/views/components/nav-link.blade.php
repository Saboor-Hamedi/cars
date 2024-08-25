{{-- @props(['active' => false])
<a class="{{ $active ? 'inline-flex items-center ' : 'text-black hover:bg-gray-700' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a> --}}

@props(['active' => false])

@php
$underlineClasses = $active 
    ? 'border-b-2 border-indigo-500' // Underline for active state
    : 'hover:border-b-2 hover:border-indigo-500'; // Underline on hover for non-active state
@endphp

<a class="{{ $active ? 'inline-flex items-center ' : 'text-black hover:bg-gray-700' }} rounded-md px-3 py-2 text-sm font-medium {{ $underlineClasses }}"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
