<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EJJ.') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex">
            
            <!-- Fondo oscuro en móvil al abrir sidebar -->
            <div x-show="sidebarOpen" 
                 @click="sidebarOpen = false" 
                 x-transition.opacity
                 class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" 
                 style="display: none;"></div>

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Columna Derecha (Header + Contenido) -->
            <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
                
                <!-- Header Superior -->
                @include('layouts.header')

                <!-- Contenido Principal -->
                <main class="flex-1 p-6 lg:p-8 max-w-7xl w-full mx-auto">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>