<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Blog') }}</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
    <link rel="stylesheet" href="{{asset('css/files.css')}}">
    <link rel="stylesheet" href="{{asset('css/easymde.min.css')}}">
    <script src="{{ asset('js/easymde.min.js') }}" defer></script>
    <script src="{{ asset('js/copyPost.js') }}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
</head>

<body>
    <main>
        {{ $slot }}
    </main>
    <script src="{{ asset('js/chatbox.js') }}"></script>
    <script src="{{ asset('js/easymde.min.js') }}"></script>
</body>

</html>