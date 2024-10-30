<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    @livewire('header')
    <main class="flex justify-center items-center w-full min-h-screen bg-gray-100">
        <div
            class="max-w-md w-full bg-white rounded-lg p-5 shadow-md hover:shadow-sm transition duration-500 ease-in-out transform mt-20 ">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
