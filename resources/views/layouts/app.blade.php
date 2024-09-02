<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/css/cards.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" as="style">
    @livewireStyles
</head>

<body>
    <div id="sidebar" class=" sidebar">
        @include('layouts.sidebar')
    </div>
    <main class="dashboard-main">

        <div class="min-h-screen bg-gray-100">
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

        </div>
    </main>
    @vite('resources/js/app.js')
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/carColor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    @livewireScripts
</body>
</html>
