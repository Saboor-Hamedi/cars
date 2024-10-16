<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Blog') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
    <link rel="stylesheet" href="{{asset('css/files.css')}}">
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div id="sidebar" class="sidebar">
        @include('layouts.sidebar')
    </div>
    <main class="dashboard-main">
        <livewire:layout.navigation />
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif
        {{ $slot }}
    </main>
    @livewireScripts
    <script src="{{asset('js/sidebar.js')}}"></script>
    <script src="{{asset('js/carColor.js')}}"></script>
</body>

</html>