{{-- Chasis del sitio público. Se usa así:  <x-public-layout title="Nosotros"> ... </x-public-layout> --}}
@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' · ' . config('app.name') : config('app.name') }}</title>

    <meta name="description"
        content="EJJ. es un sistema web de gestión de ventas e inventario para ferreterías: controla tu stock, cobra más rápido y entiende tu negocio.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased bg-white text-slate-800">

    <div class="flex min-h-screen flex-col">
        @include('layouts.public-header')

        <main class="flex-1">
            {{ $slot }}
        </main>

        @include('layouts.public-footer')
    </div>
</body>

</html>
