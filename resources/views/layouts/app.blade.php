<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Blog') }}</title>

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/files.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bg_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/easymde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <script src="{{ asset('js/easymde.min.js') }}" defer></script>
    <script src="{{ asset('js/copyPost.js') }}" defer></script>
    @vite('resources/css/app.css')
</head>

<body>
    <main>
        <div id="sidebar" class="sidebar">
            @include('layouts.sidebar')
        </div>
        <livewire:layout.navigation />

        {{ $slot }}
    </main>

    @livewireScripts
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/carColor.js') }}"></script>
    @vite('resources/js/app.js')
</body>

</html>
