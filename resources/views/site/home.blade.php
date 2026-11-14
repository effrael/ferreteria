<x-public-layout>

    {{-- ===================================================== --}}
    {{-- 1. HERO                                               --}}
    {{-- ===================================================== --}}
    <section class="relative overflow-hidden bg-surface">
        {{-- Manchas decorativas de fondo --}}
        <div aria-hidden="true"
            class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-primary/10 blur-3xl"></div>
        <div aria-hidden="true"
            class="pointer-events-none absolute -bottom-32 -left-24 h-80 w-80 rounded-full bg-primary/5 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-10">

                {{-- Columna de texto --}}
                <div>
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-primary/25 bg-primary/10 px-3.5 py-1.5 text-xs font-semibold text-primary">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        Sistema web para ferreterías
                    </span>

                    <h1 class="mt-6 text-4xl font-extrabold leading-[1.12] tracking-tight text-slate-950 sm:text-5xl">
                        Todo en orden.<br>
                        Tu negocio,<br>
                        <span class="text-primary">un paso adelante.</span>
                    </h1>

                    <p class="mt-6 max-w-md text-base leading-relaxed text-slate-600 sm:text-[17px]">
                        Gestiona tus ventas y tu inventario desde un solo lugar. Más control para ti,
                        más posibilidades para tu ferretería.
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                            Empieza gratis
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="{{ route('precios') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-6 py-3.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition">
                            Ver planes
                        </a>
                    </div>

                    {{-- Línea de confianza --}}
                    <dl class="mt-9 flex flex-wrap items-center gap-x-6 gap-y-2.5 text-xs font-medium text-slate-500">
                        @foreach (['Sin instalar nada', 'Funciona en tu navegador', 'Tus datos en la nube'] as $punto)
                            <div class="flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2.4"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <dt>{{ $punto }}</dt>
                            </div>
                        @endforeach
                    </dl>
                </div>

                {{-- Columna de vista previa del panel (ilustración, no datos reales) --}}
                <div class="relative">
                    <div
                        class="rounded-3xl border border-slate-100 bg-white p-6 shadow-[0_20px_50px_rgba(8,32,215,0.08)] sm:p-7">

                        <div class="flex items-center justify-between border-b border-slate-100 pb-5">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2.5 w-2.5 rounded-full bg-primary"></span>
                                <span class="text-sm font-bold text-slate-800">Resumen de hoy</span>
                            </div>
                            <span
                                class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-[10px] font-semibold uppercase text-slate-500">
                                Vista previa
                            </span>
                        </div>

                        {{-- Tarjetas de indicadores --}}
                        <div class="mt-5 grid grid-cols-3 gap-3">
                            @foreach ([['Vendido', 'S/ 1,240'], ['Productos', '148'], ['Stock bajo', '6']] as $kpi)
                                <div class="rounded-xl border border-slate-200/90 bg-slate-50/60 p-3.5">
                                    <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-500">
                                        {{ $kpi[0] }}
                                    </p>
                                    <p class="mt-1 text-lg font-extrabold tracking-tight text-slate-900">
                                        {{ $kpi[1] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        {{-- Filas de productos --}}
                        <div class="mt-5 space-y-2.5">
                            @foreach ([['Cemento Sol 42.5 kg', 'BLS', 'S/ 32.90'], ['Tubo PVC 1/2" x 5 m', 'UND', 'S/ 14.50'], ['Alambre N.º 16', 'KG', 'S/ 8.20']] as $fila)
                                <div
                                    class="flex items-center gap-3 rounded-xl border border-slate-200/90 bg-white p-3">
                                    <span
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-xs font-semibold uppercase tracking-wide text-slate-800">
                                            {{ $fila[0] }}
                                        </p>
                                        <p class="mt-0.5 text-[11px] text-slate-500">{{ $fila[1] }}</p>
                                    </div>
                                    <span
                                        class="shrink-0 rounded-full border border-primary/25 bg-primary/10 px-2.5 py-0.5 text-xs font-bold text-primary">
                                        {{ $fila[2] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 2. EL PROBLEMA                                        --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    ¿Te suena familiar?
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Son los problemas que escuchamos en casi toda ferretería que todavía lleva sus cuentas a mano.
                </p>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $dolores = [
                        [
                            'titulo' => 'El cuaderno de siempre',
                            'texto' => 'Las ventas del día se anotan a mano y al cierre nunca cuadra la caja con lo que se vendió.',
                            'icono' => 'M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 15v4.125c0 1.036-.84 1.875-1.875 1.875H4.875A1.875 1.875 0 013 19.125V6.375c0-1.036.84-1.875 1.875-1.875H9.75',
                        ],
                        [
                            'titulo' => 'Stock que no cuadra',
                            'texto' => 'Vendes un producto que el sistema dice que tienes, y recién en el almacén descubres que se acabó.',
                            'icono' => 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z',
                        ],
                        [
                            'titulo' => 'No sabes qué rota',
                            'texto' => 'Compras de nuevo lo que no se vende y te quedas sin lo que sí sale. Sin datos, todo es corazonada.',
                            'icono' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z',
                        ],
                        [
                            'titulo' => 'Los precios en la cabeza',
                            'texto' => 'Solo el dueño sabe a cuánto va cada cosa. Si él no está, nadie puede atender con seguridad.',
                            'icono' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292',
                        ],
                    ];
                @endphp

                @foreach ($dolores as $dolor)
                    <div
                        class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-2xs transition hover:border-primary/30">
                        <span
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $dolor['icono'] }}" />
                            </svg>
                        </span>
                        <h3 class="mt-5 text-base font-bold tracking-tight text-slate-900">
                            {{ $dolor['titulo'] }}
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">
                            {{ $dolor['texto'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 3. FUNCIONALIDADES (pestañas interactivas con Alpine)  --}}
    {{-- ===================================================== --}}
    @php
        $modulos = [
            [
                'id' => 'pos',
                'nombre' => 'Punto de venta',
                'titulo' => 'Cobra en segundos, sin calculadora',
                'texto' => 'Busca el producto por nombre o código de barras, ármalo en el carrito y cobra. El total se calcula solo y el stock baja en el mismo momento.',
                'puntos' => [
                    'Búsqueda por nombre o código de barras',
                    'Filtro por categoría con un clic',
                    'Avisa cuando un producto no tiene stock',
                    'Descuenta el inventario al cerrar la venta',
                ],
                'icono' => 'M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z',
            ],
            [
                'id' => 'inventario',
                'nombre' => 'Inventario',
                'titulo' => 'Tu almacén, siempre al día',
                'texto' => 'Registra cada producto con su foto, su código, su precio de compra y de venta. Consulta en cualquier momento qué tienes y cuánto queda.',
                'puntos' => [
                    'Precio de compra y de venta por producto',
                    'Foto, código y descripción',
                    'Control de stock por unidad de medida',
                    'Activa o desactiva productos sin borrarlos',
                ],
                'icono' => 'M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9',
            ],
            [
                'id' => 'catalogos',
                'nombre' => 'Catálogos',
                'titulo' => 'Ordena tu ferretería a tu manera',
                'texto' => 'Categorías, marcas y unidades de medida configurables. Tú decides cómo se agrupa tu mercadería, porque nadie conoce tu negocio mejor que tú.',
                'puntos' => [
                    'Categorías propias (gasfitería, pinturas, eléctricos...)',
                    'Marcas con las que trabajas',
                    'Unidades reales: bolsa, metro, kilo, unidad',
                    'Se crean desde la misma pantalla de producto',
                ],
                'icono' => 'M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5',
            ],
            [
                'id' => 'roles',
                'nombre' => 'Usuarios y roles',
                'titulo' => 'Cada uno ve lo que le toca',
                'texto' => 'Tu vendedor cobra, tu almacenero revisa stock y tú ves todo. Sin que nadie toque lo que no debe.',
                'puntos' => [
                    'Perfiles de administrador, vendedor y almacenero',
                    'El menú cambia según el rol',
                    'Varios usuarios trabajando a la vez',
                    'Cada venta queda registrada con su responsable',
                ],
                'icono' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
            ],
        ];
    @endphp

    <section class="bg-surface py-20 sm:py-24" x-data="{ activo: 'pos' }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    Todo lo que tu ferretería necesita
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Cuatro módulos que trabajan juntos. Sin plugins, sin configuraciones eternas.
                </p>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-10">

                {{-- Pestañas --}}
                <div class="lg:col-span-4">
                    <div class="flex gap-2 overflow-x-auto pb-2 lg:flex-col lg:overflow-visible lg:pb-0">
                        @foreach ($modulos as $modulo)
                            <button type="button" @click="activo = '{{ $modulo['id'] }}'"
                                :class="activo === '{{ $modulo['id'] }}'
                                    ? 'border-primary/30 bg-white shadow-[0_10px_30px_rgba(8,32,215,0.07)]'
                                    : 'border-transparent bg-white/50 hover:bg-white'"
                                class="flex shrink-0 items-center gap-3 rounded-xl border px-4 py-3.5 text-left transition cursor-pointer lg:w-full">
                                <span
                                    :class="activo === '{{ $modulo['id'] }}' ? 'bg-primary text-white' : 'bg-primary/10 text-primary'"
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="{{ $modulo['icono'] }}" />
                                    </svg>
                                </span>
                                <span
                                    :class="activo === '{{ $modulo['id'] }}' ? 'text-slate-900' : 'text-slate-600'"
                                    class="text-sm font-semibold whitespace-nowrap lg:whitespace-normal">
                                    {{ $modulo['nombre'] }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Contenido de la pestaña activa --}}
                <div class="lg:col-span-8">
                    @foreach ($modulos as $modulo)
                        <div x-show="activo === '{{ $modulo['id'] }}'" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="rounded-3xl border border-slate-100 bg-white p-7 shadow-[0_20px_50px_rgba(8,32,215,0.06)] sm:p-9">

                            <h3 class="text-2xl font-extrabold tracking-tight text-slate-950">
                                {{ $modulo['titulo'] }}
                            </h3>
                            <p class="mt-3 text-base leading-relaxed text-slate-600">
                                {{ $modulo['texto'] }}
                            </p>

                            <ul class="mt-7 grid grid-cols-1 gap-3.5 sm:grid-cols-2">
                                @foreach ($modulo['puntos'] as $punto)
                                    <li class="flex items-start gap-2.5">
                                        <span
                                            class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </span>
                                        <span class="text-sm leading-relaxed text-slate-700">{{ $punto }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 4. CÓMO FUNCIONA                                      --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    Empezar toma una tarde
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    No necesitas técnico ni instalar programas. Tres pasos y estás vendiendo.
                </p>
            </div>

            <div class="relative mt-14">
                {{-- Línea que conecta los pasos en escritorio --}}
                <div aria-hidden="true"
                    class="absolute left-0 right-0 top-7 hidden h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent lg:block">
                </div>

                <ol class="relative grid grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-8">
                    @php
                        $pasos = [
                            ['Crea tu cuenta', 'Te registras con tu correo y entras al panel. No pedimos tarjeta para probar.'],
                            ['Carga tu inventario', 'Registras tus productos con su precio y su stock, y los agrupas en tus propias categorías.'],
                            ['Empieza a vender', 'Abres el punto de venta, buscas el producto y cobras. El stock se actualiza solo.'],
                        ];
                    @endphp

                    @foreach ($pasos as $i => $paso)
                        <li class="text-center lg:text-left">
                            <span
                                class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-primary text-lg font-extrabold text-white shadow-lg shadow-primary/25">
                                {{ $i + 1 }}
                            </span>
                            <h3 class="mt-5 text-lg font-bold tracking-tight text-slate-900">
                                {{ $paso[0] }}
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600 lg:max-w-xs">
                                {{ $paso[1] }}
                            </p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 5. EN CAMINO (roadmap honesto)                        --}}
    {{-- ===================================================== --}}
    <section class="border-y border-slate-200/80 bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-start justify-between gap-7 lg:flex-row lg:items-center">

                <div class="max-w-md">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-slate-500">
                        En desarrollo
                    </span>
                    <h2 class="mt-4 text-2xl font-extrabold tracking-tight text-slate-950">
                        Lo que viene después
                    </h2>
                    <p class="mt-3 text-sm leading-relaxed text-slate-600">
                        Preferimos decirte qué estamos construyendo antes que prometerte lo que todavía no existe.
                        Si necesitas alguno de estos módulos, escríbenos y lo priorizamos.
                    </p>
                </div>

                <div class="grid w-full grid-cols-2 gap-3 sm:grid-cols-4 lg:w-auto lg:max-w-xl">
                    @foreach (['Reportes y gráficos', 'Cotizaciones', 'Órdenes de venta', 'Registro de clientes', 'Métodos de pago', 'Comprobantes SUNAT', 'Múltiples sucursales', 'App móvil'] as $pendiente)
                        <span
                            class="rounded-lg border border-dashed border-slate-300 bg-white/60 px-3 py-2.5 text-center text-xs font-medium text-slate-500">
                            {{ $pendiente }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 6. LLAMADA FINAL                                      --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-primary px-6 py-14 text-center sm:px-14">

                <div aria-hidden="true"
                    class="pointer-events-none absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl">
                </div>
                <div aria-hidden="true"
                    class="pointer-events-none absolute -bottom-24 -left-16 h-64 w-64 rounded-full bg-white/5 blur-3xl">
                </div>

                <div class="relative mx-auto max-w-2xl">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        Deja el cuaderno esta semana
                    </h2>
                    <p class="mt-4 text-base leading-relaxed text-white/80">
                        Crea tu cuenta, carga tus productos y haz tu primera venta hoy mismo.
                        Si tienes dudas, conversamos antes de que decidas.
                    </p>

                    <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <a href="{{ route('register') }}"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-6 py-3.5 text-sm font-bold text-primary shadow-lg hover:bg-slate-50 transition sm:w-auto">
                            Empieza gratis
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="{{ route('contacto') }}"
                            class="inline-flex w-full items-center justify-center rounded-lg border border-white/30 px-6 py-3.5 text-sm font-bold text-white hover:bg-white/10 transition sm:w-auto">
                            Hablar con nosotros
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
