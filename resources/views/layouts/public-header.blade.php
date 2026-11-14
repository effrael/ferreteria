{{-- Cabecera del sitio público (Home + páginas informativas). --}}
{{-- La cabecera del panel autenticado es layouts/header.blade.php, no esta. --}}

@php
    $enlaces = [
        ['label' => 'Inicio', 'route' => 'home'],
        ['label' => 'Nosotros', 'route' => 'nosotros'],
        ['label' => 'Precios', 'route' => 'precios'],
        ['label' => 'FAQs', 'route' => 'faqs'],
        ['label' => 'Contacto', 'route' => 'contacto'],
    ];
@endphp

<header x-data="{ menuAbierto: false }"
    class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-slate-200/80">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">

            {{-- Logo: mismo cubo y wordmark que el panel de login --}}
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5">
                <span
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary text-white shadow-lg shadow-primary/30">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                        <polyline points="3.29 7 12 12 20.71 7" />
                        <line x1="12" y1="22" x2="12" y2="12" />
                    </svg>
                </span>
                <span class="text-xl font-extrabold tracking-tight text-primary">
                    EJJ<span class="text-primary/40">.</span>
                </span>
            </a>

            {{-- Menú de escritorio --}}
            <nav class="hidden lg:flex items-center gap-1">
                @foreach ($enlaces as $enlace)
                    <a href="{{ route($enlace['route']) }}"
                        class="rounded-lg px-3.5 py-2 text-sm font-medium transition-colors duration-150
                            {{ request()->routeIs($enlace['route'])
                                ? 'bg-primary/10 text-primary font-semibold'
                                : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        {{ $enlace['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Acciones de escritorio --}}
            <div class="hidden lg:flex shrink-0 items-center gap-2.5">
                @auth
                    {{-- Solo quien tiene acceso al panel ve este botón; el resto va a su perfil. --}}
                    <a href="{{ auth()->user()->tieneAccesoAlPanel() ? route('admin.ventas.index') : route('profile.edit') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                        {{ auth()->user()->tieneAccesoAlPanel() ? 'Ir al panel' : 'Mi cuenta' }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-lg px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                        Prueba gratis
                    </a>
                @endauth
            </div>

            {{-- Botón hamburguesa (móvil) --}}
            <button type="button" @click="menuAbierto = !menuAbierto" :aria-expanded="menuAbierto"
                aria-label="Abrir menú"
                class="lg:hidden -mr-2 rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition">
                <svg x-show="!menuAbierto" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="menuAbierto" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menú desplegable (móvil) --}}
    <div x-show="menuAbierto" x-cloak @click.outside="menuAbierto = false"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden border-t border-slate-100 bg-white px-4 pb-5 pt-3 sm:px-6">

        <nav class="flex flex-col gap-1">
            @foreach ($enlaces as $enlace)
                <a href="{{ route($enlace['route']) }}"
                    class="rounded-lg px-3.5 py-2.5 text-sm font-medium transition-colors
                        {{ request()->routeIs($enlace['route'])
                            ? 'bg-primary/10 text-primary font-semibold'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    {{ $enlace['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-4 flex flex-col gap-2.5 border-t border-slate-100 pt-4">
            @auth
                <a href="{{ auth()->user()->tieneAccesoAlPanel() ? route('admin.ventas.index') : route('profile.edit') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                    {{ auth()->user()->tieneAccesoAlPanel() ? 'Ir al panel' : 'Mi cuenta' }}
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                    Prueba gratis
                </a>
            @endauth
        </div>
    </div>
</header>
