<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>
    <div id="sidebar" class="hidden sidebar ">
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

    <script src="{{ asset('js/sidebar.js') }}"></script>
    @vite('resources/js/app.js')
    @livewireScripts
</body>

</html>
