<x-public-layout title="Nosotros">

    {{-- ===================================================== --}}
    {{-- 1. ENCABEZADO DE PÁGINA                               --}}
    {{-- ===================================================== --}}
    <section class="relative overflow-hidden border-b border-slate-200/80 bg-surface">
        <div aria-hidden="true"
            class="pointer-events-none absolute -right-20 -top-28 h-80 w-80 rounded-full bg-primary/10 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-3xl">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-primary/25 bg-primary/10 px-3.5 py-1.5 text-xs font-semibold text-primary">
                    <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                    Nosotros
                </span>

                <h1 class="mt-6 text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-950 sm:text-5xl">
                    Hacemos software para<br>
                    <span class="text-primary">quien atiende el mostrador.</span>
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-[17px]">
                    EJJ. nace de una observación simple: la mayoría de las ferreterías del país mueve
                    miles de soles al mes con un cuaderno y una calculadora. No por falta de ganas,
                    sino porque el software que existe está pensado para grandes empresas.
                </p>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 2. EL ORIGEN                                          --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-16">

                <div class="lg:col-span-7">
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                        Por qué existe EJJ.
                    </h2>

                    <div class="mt-7 space-y-5 text-base leading-relaxed text-slate-600">
                        <p>
                            Cuando empezamos a estudiar cómo trabajan las ferreterías pequeñas y medianas,
                            encontramos el mismo patrón en todas: el dueño lleva el negocio en la cabeza.
                            Sabe los precios, sabe qué falta, sabe a quién le debe. Y todo funciona
                            <span class="font-semibold text-slate-800">hasta el día que él no está</span>.
                        </p>
                        <p>
                            El software de gestión que había en el mercado les quedaba grande: licencias caras,
                            instalación en una sola computadora, menús con cien opciones que nadie usa y
                            capacitaciones de varios días. Al final volvían al cuaderno, porque el cuaderno
                            al menos no se cae.
                        </p>
                        <p>
                            Así que decidimos construir lo contrario: un sistema que haga
                            <span class="font-semibold text-slate-800">pocas cosas y las haga bien</span>.
                            Que se abra en el navegador sin instalar nada, que un vendedor nuevo entienda
                            en diez minutos, y que cueste lo que una ferretería de barrio puede pagar.
                        </p>
                    </div>
                </div>

                {{-- Cita destacada --}}
                <div class="lg:col-span-5">
                    <figure
                        class="rounded-3xl border border-slate-100 bg-surface p-8 shadow-[0_20px_50px_rgba(8,32,215,0.06)]">
                        <svg class="h-8 w-8 text-primary/30" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                        </svg>

                        <blockquote class="mt-5 text-lg font-semibold leading-relaxed tracking-tight text-slate-900">
                            «Yo sé qué tengo en la tienda. El problema es que solo yo lo sé.»
                        </blockquote>

                        <figcaption class="mt-5 border-t border-slate-200/80 pt-5 text-sm text-slate-500">
                            Lo que nos dijo un ferretero cuando le preguntamos por su inventario.
                            Esa frase resume el problema que intentamos resolver.
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 3. MISIÓN Y VISIÓN                                    --}}
    {{-- ===================================================== --}}
    <section class="border-y border-slate-200/80 bg-surface py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- Misión --}}
                <div class="rounded-3xl border border-slate-100 bg-white p-8 sm:p-10">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.63 2.46m5.96 11.91a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                    </span>

                    <h2 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-950">Nuestra misión</h2>
                    <p class="mt-4 text-base leading-relaxed text-slate-600">
                        Poner al alcance de cualquier ferretería una herramienta que le permita saber
                        exactamente qué vende y qué tiene, sin necesitar un contador, un técnico
                        ni una inversión que no puede justificar.
                    </p>
                </div>

                {{-- Visión --}}
                <div class="rounded-3xl border border-slate-100 bg-white p-8 sm:p-10">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>

                    <h2 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-950">Nuestra visión</h2>
                    <p class="mt-4 text-base leading-relaxed text-slate-600">
                        Ser el sistema que la ferretería de barrio adopta primero y no abandona:
                        el estándar de gestión para el comercio ferretero en el Perú, construido
                        a partir de lo que los propios ferreteros nos piden.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 4. VALORES                                            --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    Cómo trabajamos
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Cuatro reglas que nos guían cada vez que decidimos si una función entra o no al producto.
                </p>
            </div>

            @php
                $valores = [
                    [
                        'titulo' => 'Simple antes que completo',
                        'texto' => 'Si una función necesita un manual, está mal diseñada. Preferimos cuatro módulos que se entiendan a veinte que nadie abre.',
                        'icono' => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z',
                    ],
                    [
                        'titulo' => 'Decimos lo que hay',
                        'texto' => 'No vendemos funciones que no existen. Lo que está en desarrollo lo decimos en la página principal, con su nombre y sin letra chica.',
                        'icono' => 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z',
                    ],
                    [
                        'titulo' => 'Tus datos son tuyos',
                        'texto' => 'Tu inventario y tus ventas son información de tu negocio. No los vendemos, no los compartimos y puedes llevártelos cuando quieras.',
                        'icono' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751A11.959 11.959 0 0112 2.714z',
                    ],
                    [
                        'titulo' => 'Escuchamos al mostrador',
                        'texto' => 'Las mejoras salen de lo que nos cuenta quien usa el sistema todos los días, no de lo que creemos que necesita.',
                        'icono' => 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z',
                    ],
                ];
            @endphp

            <div class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2">
                @foreach ($valores as $valor)
                    <div
                        class="flex gap-5 rounded-2xl border border-slate-200/90 bg-white p-6 shadow-2xs transition hover:border-primary/30">
                        <span
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $valor['icono'] }}" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-base font-bold tracking-tight text-slate-900">{{ $valor['titulo'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $valor['texto'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 5. EL EQUIPO                                          --}}
    {{-- ===================================================== --}}
    {{-- IMPORTANTE: reemplaza los nombres y roles por los reales de tu equipo. --}}
    @php
        $equipo = [
            ['nombre' => 'Nombre Apellido', 'rol' => 'Desarrollo backend', 'iniciales' => 'E'],
            ['nombre' => 'Nombre Apellido', 'rol' => 'Desarrollo frontend', 'iniciales' => 'J'],
            ['nombre' => 'Nombre Apellido', 'rol' => 'Base de datos y análisis', 'iniciales' => 'J'],
        ];
    @endphp

    <section class="border-y border-slate-200/80 bg-surface py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    Quiénes estamos detrás
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Un equipo pequeño que diseña, programa y atiende el soporte. Cuando escribes,
                    te responde alguien que conoce el código.
                </p>
            </div>

            <div class="mx-auto mt-14 grid max-w-4xl grid-cols-1 gap-5 sm:grid-cols-3">
                @foreach ($equipo as $persona)
                    <div class="rounded-2xl border border-slate-100 bg-white p-7 text-center">
                        <span
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-primary text-xl font-extrabold text-white shadow-lg shadow-primary/25">
                            {{ $persona['iniciales'] }}
                        </span>
                        <h3 class="mt-5 text-base font-bold tracking-tight text-slate-900">
                            {{ $persona['nombre'] }}
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">{{ $persona['rol'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 6. SOBRE QUÉ ESTÁ CONSTRUIDO                          --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-12 lg:gap-16">

                <div class="lg:col-span-5">
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                        Sobre qué está construido
                    </h2>
                    <p class="mt-5 text-base leading-relaxed text-slate-600">
                        EJJ. corre sobre tecnologías estándar y de código abierto. No dependes de un
                        proveedor que desaparece ni de un formato que nadie más puede leer.
                    </p>
                    <a href="{{ route('contacto') }}"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-primary hover:gap-3 transition-all">
                        ¿Tienes una consulta técnica? Escríbenos
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="lg:col-span-7">
                    @php
                        $stack = [
                            ['Laravel', 'El framework PHP sobre el que corre toda la aplicación.'],
                            ['MySQL', 'Base de datos relacional para tu inventario y tus ventas.'],
                            ['Tailwind CSS', 'La interfaz, pensada para verse bien en cualquier pantalla.'],
                            ['Alpine.js', 'Las partes interactivas, como el punto de venta.'],
                        ];
                    @endphp

                    <div class="grid grid-cols-1 gap-3.5 sm:grid-cols-2">
                        @foreach ($stack as $tec)
                            <div class="rounded-2xl border border-slate-200/90 bg-slate-50/60 p-5">
                                <p class="text-sm font-bold tracking-tight text-slate-900">{{ $tec[0] }}</p>
                                <p class="mt-1.5 text-xs leading-relaxed text-slate-600">{{ $tec[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 7. LLAMADA FINAL                                      --}}
    {{-- ===================================================== --}}
    <section class="border-t border-slate-200/80 bg-surface py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col items-start justify-between gap-7 rounded-3xl border border-slate-100 bg-white p-8 shadow-[0_20px_50px_rgba(8,32,215,0.06)] sm:p-10 lg:flex-row lg:items-center">

                <div class="max-w-xl">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">
                        ¿Conversamos sobre tu ferretería?
                    </h2>
                    <p class="mt-3 text-base leading-relaxed text-slate-600">
                        Cuéntanos cómo llevas hoy tus ventas y tu stock. Te decimos con honestidad
                        si EJJ. te sirve o todavía no.
                    </p>
                </div>

                <div class="flex w-full shrink-0 flex-col gap-3 sm:flex-row lg:w-auto">
                    <a href="{{ route('contacto') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                        Contáctanos
                    </a>
                    <a href="{{ route('precios') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-6 py-3.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition">
                        Ver planes
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
