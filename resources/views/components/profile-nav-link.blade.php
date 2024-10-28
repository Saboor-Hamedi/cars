@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center p-4  border-b-2 border-purple rounded-t-lg'
            : 'inline-flex items-center p-4 ';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
