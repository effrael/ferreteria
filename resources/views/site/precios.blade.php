{{-- IMPORTANTE: los precios están en el array $planes de abajo. Ajústalos ahí. --}}
@php
    $planes = [
        [
            'nombre' => 'Inicio',
            'resumen' => 'Para la ferretería que recién deja el cuaderno.',
            'mensual' => '39',
            'anualMes' => '32.50',
            'anualTotal' => '390',
            'destacado' => false,
            'incluye' => [
                '1 usuario',
                'Hasta 300 productos',
                'Punto de venta completo',
                'Control de inventario y stock',
                'Categorías, marcas y unidades',
                'Soporte por correo',
            ],
        ],
        [
            'nombre' => 'Negocio',
            'resumen' => 'Para la ferretería con vendedores y almacenero.',
            'mensual' => '79',
            'anualMes' => '65.83',
            'anualTotal' => '790',
            'destacado' => true,
            'incluye' => [
                'Hasta 5 usuarios',
                'Productos ilimitados',
                'Punto de venta completo',
                'Control de inventario y stock',
                'Roles de administrador, vendedor y almacenero',
                'Soporte por WhatsApp',
            ],
        ],
        [
            'nombre' => 'Ferretería',
            'resumen' => 'Para quien ya mueve volumen y necesita acompañamiento.',
            'mensual' => '149',
            'anualMes' => '124.17',
            'anualTotal' => '1,490',
            'destacado' => false,
            'incluye' => [
                'Usuarios ilimitados',
                'Productos ilimitados',
                'Todo lo del plan Negocio',
                'Capacitación inicial a tu equipo',
                'Soporte prioritario por WhatsApp',
                'Acceso anticipado a nuevos módulos',
            ],
        ],
    ];
@endphp

<x-public-layout title="Precios">

    <div x-data="{ anual: false }">

        {{-- ===================================================== --}}
        {{-- 1. ENCABEZADO + INTERRUPTOR MENSUAL / ANUAL           --}}
        {{-- ===================================================== --}}
        <section class="relative overflow-hidden bg-surface">
            <div aria-hidden="true"
                class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-primary/10 blur-3xl">
            </div>

            <div class="relative mx-auto max-w-7xl px-4 pt-20 pb-28 sm:px-6 sm:pt-24 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-primary/25 bg-primary/10 px-3.5 py-1.5 text-xs font-semibold text-primary">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        Planes y precios
                    </span>

                    <h1 class="mt-6 text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-950 sm:text-5xl">
                        Un precio que tu<br>
                        <span class="text-primary">ferretería puede pagar.</span>
                    </h1>

                    <p class="mt-6 text-base leading-relaxed text-slate-600 sm:text-[17px]">
                        Sin costo de instalación, sin contrato de permanencia y sin cobros por actualización.
                        Cambias de plan o te vas cuando quieras.
                    </p>
                </div>

                {{-- Interruptor --}}
                <div class="mt-11 flex flex-col items-center gap-3">
                    <div class="inline-flex items-center rounded-xl border border-slate-200 bg-white p-1 shadow-2xs">
                        <button type="button" @click="anual = false"
                            :class="!anual ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-600 hover:text-slate-900'"
                            class="rounded-lg px-5 py-2 text-sm font-semibold transition cursor-pointer">
                            Mensual
                        </button>
                        <button type="button" @click="anual = true"
                            :class="anual ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-600 hover:text-slate-900'"
                            class="rounded-lg px-5 py-2 text-sm font-semibold transition cursor-pointer">
                            Anual
                        </button>
                    </div>

                    <p class="flex items-center gap-1.5 text-xs font-semibold text-primary">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                        </svg>
                        Paga al año y te llevas 2 meses gratis
                    </p>
                </div>
            </div>
        </section>

        {{-- ===================================================== --}}
        {{-- 2. TARJETAS DE PLANES                                 --}}
        {{-- ===================================================== --}}
        <section class="relative bg-white pb-20 sm:pb-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="-mt-16 grid grid-cols-1 gap-6 lg:grid-cols-3">

                    @foreach ($planes as $plan)
                        <div
                            class="relative flex flex-col rounded-3xl bg-white p-8
                                {{ $plan['destacado']
                                    ? 'border-2 border-primary shadow-[0_20px_50px_rgba(8,32,215,0.12)] lg:-mt-4 lg:pb-12'
                                    : 'border border-slate-200/90 shadow-[0_20px_50px_rgba(8,32,215,0.06)]' }}">

                            @if ($plan['destacado'])
                                <span
                                    class="absolute -top-3.5 left-1/2 -translate-x-1/2 rounded-full bg-primary px-4 py-1.5 text-[11px] font-bold uppercase tracking-wide text-white shadow-lg shadow-primary/30">
                                    Más elegido
                                </span>
                            @endif

                            <h2 class="text-lg font-extrabold tracking-tight text-slate-950">{{ $plan['nombre'] }}</h2>
                            <p class="mt-2 min-h-[2.75rem] text-sm leading-relaxed text-slate-600">
                                {{ $plan['resumen'] }}
                            </p>

                            {{-- Precio --}}
                            <div class="mt-6 border-t border-slate-100 pt-6">
                                <div class="flex items-baseline gap-1.5">
                                    <span class="text-sm font-bold text-slate-500">S/</span>
                                    <span class="text-4xl font-extrabold tracking-tight text-slate-950"
                                        x-text="anual ? '{{ $plan['anualMes'] }}' : '{{ $plan['mensual'] }}'">
                                        {{ $plan['mensual'] }}
                                    </span>
                                    <span class="text-sm font-medium text-slate-500">/ mes</span>
                                </div>

                                <p class="mt-2 text-xs text-slate-500">
                                    <span x-show="!anual">Facturado cada mes. IGV incluido.</span>
                                    <span x-show="anual" x-cloak>
                                        Facturado S/ {{ $plan['anualTotal'] }} al año. IGV incluido.
                                    </span>
                                </p>
                            </div>

                            {{-- Incluye --}}
                            <ul class="mt-7 flex-1 space-y-3">
                                @foreach ($plan['incluye'] as $item)
                                    <li class="flex items-start gap-2.5">
                                        <span
                                            class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </span>
                                        <span class="text-sm leading-relaxed text-slate-700">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('register') }}"
                                class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-lg px-6 py-3.5 text-sm font-bold transition
                                    {{ $plan['destacado']
                                        ? 'bg-primary text-white shadow-lg shadow-primary/25 hover:bg-primary/90'
                                        : 'border border-slate-200 bg-white text-slate-700 hover:bg-slate-50' }}">
                                Empezar con {{ $plan['nombre'] }}
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Nota de prueba gratuita --}}
                <p class="mt-10 text-center text-sm text-slate-500">
                    Todos los planes empiezan con <span class="font-semibold text-slate-700">14 días de prueba</span>,
                    sin tarjeta de crédito.
                    ¿No sabes cuál te conviene?
                    <a href="{{ route('contacto') }}" class="font-semibold text-primary hover:underline">
                        Escríbenos y lo vemos juntos</a>.
                </p>
            </div>
        </section>
    </div>

    {{-- ===================================================== --}}
    {{-- 3. TODOS LOS PLANES INCLUYEN                           --}}
    {{-- ===================================================== --}}
    <section class="border-y border-slate-200/80 bg-surface py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <h2 class="text-center text-2xl font-extrabold tracking-tight text-slate-950">
                Todos los planes incluyen
            </h2>

            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $comunes = [
                        ['Sin instalación', 'Entras desde el navegador de cualquier computadora.', 'M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z'],
                        ['Respaldo diario', 'Tu información se guarda todos los días, sin que hagas nada.', 'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375 7.444 2.25 12 2.25s8.25 1.847 8.25 4.125zM3.75 6.375v11.25c0 2.278 3.694 4.125 8.25 4.125s8.25-1.847 8.25-4.125V6.375'],
                        ['Actualizaciones gratis', 'Cada módulo nuevo llega a tu cuenta sin costo extra.', 'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99'],
                        ['Sin permanencia', 'Cancelas cuando quieras. No hay penalidad ni letra chica.', 'M8.25 9V5.25A2.25 2.25 0 0110.5 3h6a2.25 2.25 0 012.25 2.25v13.5A2.25 2.25 0 0116.5 21h-6a2.25 2.25 0 01-2.25-2.25V15m-3 0l-3-3m0 0l3-3m-3 3H15'],
                    ];
                @endphp

                @foreach ($comunes as $comun)
                    <div class="rounded-2xl border border-slate-100 bg-white p-6">
                        <span
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $comun[2] }}" />
                            </svg>
                        </span>
                        <h3 class="mt-5 text-base font-bold tracking-tight text-slate-900">{{ $comun[0] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $comun[1] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 4. TABLA COMPARATIVA                                   --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    Compara los planes
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Lo que cambia de un plan a otro, en una sola vista.
                </p>
            </div>

            @php
                // true = incluido, false = no incluido, texto = valor
                $filas = [
                    ['Usuarios del sistema', '1', 'Hasta 5', 'Ilimitados'],
                    ['Productos en inventario', 'Hasta 300', 'Ilimitados', 'Ilimitados'],
                    ['Punto de venta', true, true, true],
                    ['Control de inventario y stock', true, true, true],
                    ['Categorías, marcas y unidades', true, true, true],
                    ['Roles de usuario', false, true, true],
                    ['Respaldo diario de datos', true, true, true],
                    ['Capacitación inicial', false, false, true],
                    ['Acceso anticipado a nuevos módulos', false, false, true],
                    ['Soporte', 'Correo', 'WhatsApp', 'WhatsApp prioritario'],
                ];
            @endphp

            <div class="mt-12 overflow-x-auto">
                <table class="w-full min-w-[640px] border-separate border-spacing-0 text-sm">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="rounded-tl-2xl border-y border-l border-slate-200 bg-slate-50/80 px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Característica
                            </th>
                            @foreach ($planes as $i => $plan)
                                <th scope="col"
                                    class="border-y border-l border-slate-200 bg-slate-50/80 px-5 py-4 text-center text-sm font-extrabold tracking-tight
                                        {{ $plan['destacado'] ? 'text-primary' : 'text-slate-900' }}
                                        {{ $i === count($planes) - 1 ? 'rounded-tr-2xl border-r' : '' }}">
                                    {{ $plan['nombre'] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filas as $f => $fila)
                            @php $ultima = $f === count($filas) - 1; @endphp
                            <tr>
                                <th scope="row"
                                    class="border-b border-l border-slate-200 px-5 py-4 text-left font-medium text-slate-700
                                        {{ $ultima ? 'rounded-bl-2xl' : '' }}">
                                    {{ $fila[0] }}
                                </th>

                                @for ($c = 1; $c <= 3; $c++)
                                    <td
                                        class="border-b border-l border-slate-200 px-5 py-4 text-center
                                            {{ $c === 3 ? 'border-r' : '' }}
                                            {{ $ultima && $c === 3 ? 'rounded-br-2xl' : '' }}
                                            {{ $planes[$c - 1]['destacado'] ? 'bg-primary/[0.03]' : '' }}">

                                        @if ($fila[$c] === true)
                                            <span
                                                class="mx-auto flex h-5 w-5 items-center justify-center rounded-full bg-primary/10 text-primary">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="3" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        @elseif ($fila[$c] === false)
                                            <span class="text-slate-300" aria-label="No incluido">—</span>
                                        @else
                                            <span class="font-semibold text-slate-800">{{ $fila[$c] }}</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 5. DUDAS SOBRE EL PAGO                                 --}}
    {{-- ===================================================== --}}
    <section class="border-t border-slate-200/80 bg-surface py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-16">

                <div class="lg:col-span-4">
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                        Dudas sobre el pago
                    </h2>
                    <p class="mt-5 text-base leading-relaxed text-slate-600">
                        Las preguntas que nos hacen antes de contratar. Si la tuya no está aquí,
                        la respondemos en un día.
                    </p>
                    <a href="{{ route('faqs') }}"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-primary hover:gap-3 transition-all">
                        Ver todas las preguntas frecuentes
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="lg:col-span-8">
                    @php
                        $dudas = [
                            ['¿Necesito tarjeta para probar?', 'No. Creas tu cuenta y tienes 14 días completos para usar el sistema. Recién al final decides si sigues.'],
                            ['¿Puedo cambiar de plan después?', 'Sí, en cualquier momento. Si subes de plan pagas solo la diferencia; si bajas, el cambio aplica en el siguiente ciclo.'],
                            ['¿Qué pasa si dejo de pagar?', 'Tu cuenta queda en pausa, no se borra. Tus productos y tus ventas siguen ahí, y puedes exportarlos cuando quieras.'],
                            ['¿Cómo puedo pagar?', 'Transferencia bancaria, Yape o Plin. Te enviamos el comprobante de pago por cada cobro.'],
                        ];
                    @endphp

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        @foreach ($dudas as $duda)
                            <div class="rounded-2xl border border-slate-100 bg-white p-6">
                                <h3 class="text-sm font-bold tracking-tight text-slate-900">{{ $duda[0] }}</h3>
                                <p class="mt-2.5 text-sm leading-relaxed text-slate-600">{{ $duda[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 6. LLAMADA FINAL                                       --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-primary px-6 py-14 text-center sm:px-14">
                <div aria-hidden="true"
                    class="pointer-events-none absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl">
                </div>

                <div class="relative mx-auto max-w-2xl">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        Pruébalo 14 días. Sin pagar nada.
                    </h2>
                    <p class="mt-4 text-base leading-relaxed text-white/80">
                        Si al final no te sirve, no pasa nada: no te pedimos tarjeta para empezar.
                    </p>

                    <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <a href="{{ route('register') }}"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-6 py-3.5 text-sm font-bold text-primary shadow-lg hover:bg-slate-50 transition sm:w-auto">
                            Crear mi cuenta
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="{{ route('contacto') }}"
                            class="inline-flex w-full items-center justify-center rounded-lg border border-white/30 px-6 py-3.5 text-sm font-bold text-white hover:bg-white/10 transition sm:w-auto">
                            Hablar con ventas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
