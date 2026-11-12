<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
  <body class="font-sans text-slate-900 antialiased bg-white">
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Columna Izquierda: Panel de Branding -->
            <div class="hidden lg:block">
                <x-left-panel />
            </div>

            <!-- Columna Derecha: Formulario -->
            <div class="flex flex-col justify-center items-center px-6 py-12 sm:px-12 lg:px-16 bg-white">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
