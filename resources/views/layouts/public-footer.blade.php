{{-- Pie de página del sitio público (Home + páginas informativas). --}}
{{-- OJO: reemplaza el correo, el teléfono y la ubicación por los datos reales de tu equipo. --}}

@php
    $correo = 'hola@ejj.pe';
    $telefono = '+51 987 654 321';
    $whatsapp = '51987654321'; // sin + ni espacios, para el enlace de wa.me
@endphp

<footer class="border-t border-slate-200/80 bg-surface">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-5">

            {{-- Marca y propuesta de valor --}}
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
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

                <p class="mt-5 max-w-sm text-sm leading-relaxed text-slate-600">
                    Software de gestión de ventas e inventario hecho para ferreterías.
                    Controla tu stock, cobra más rápido y entiende tu negocio desde un solo lugar.
                </p>

                <p class="mt-5 text-xs font-medium text-slate-500">
                    Hecho en Perú para ferreterías peruanas.
                </p>
            </div>

            {{-- Producto --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Producto</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('precios') }}" class="text-slate-600 hover:text-primary transition">
                            Planes y precios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faqs') }}" class="text-slate-600 hover:text-primary transition">
                            Preguntas frecuentes
                        </a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('register') }}" class="text-slate-600 hover:text-primary transition">
                                Crear cuenta
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-primary transition">
                                Iniciar sesión
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ auth()->user()->tieneAccesoAlPanel() ? route('admin.ventas.index') : route('profile.edit') }}" class="text-slate-600 hover:text-primary transition">
                                {{ auth()->user()->tieneAccesoAlPanel() ? 'Ir al panel' : 'Mi cuenta' }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>

            {{-- Empresa --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Empresa</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('nosotros') }}" class="text-slate-600 hover:text-primary transition">
                            Nosotros
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacto') }}" class="text-slate-600 hover:text-primary transition">
                            Contacto
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacto') }}" class="text-slate-600 hover:text-primary transition">
                            Solicitar una demo
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contacto --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Contáctanos</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <a href="mailto:{{ $correo }}" class="text-slate-600 hover:text-primary transition">
                            {{ $correo }}
                        </a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener"
                            class="text-slate-600 hover:text-primary transition">
                            {{ $telefono }}
                        </a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292" />
                        </svg>
                        <span class="text-slate-600">Lima, Perú</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-slate-600">
                            Lun a Vie, 9:00 – 18:00<br>
                            Sáb, 9:00 – 13:00
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Barra inferior --}}
        <div
            class="mt-12 flex flex-col items-center justify-between gap-3 border-t border-slate-200/80 pt-6 sm:flex-row">
            <p class="text-xs text-slate-500">
                &copy; {{ now()->year }} EJJ. Todos los derechos reservados.
            </p>
            <p class="text-xs text-slate-500">
                Sistema web de gestión de ventas e inventario para ferreterías.
            </p>
        </div>
    </div>
</footer>
