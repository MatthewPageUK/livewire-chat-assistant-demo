<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Matthew Page - Livewire Demo Chat Assistant</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=atma:300,400,500,600,700&display=swap" rel="stylesheet" />

        {{-- @vite('resources/css/app.css') --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-primary-100">
        {{ $slot }}
    </body>
</html>
