@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center p-3 border-b-2 border-purple rounded-t-lg'
            : 'inline-flex items-center p-3 ';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
    {{ $slot }}
</a>
