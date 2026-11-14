{{-- IMPORTANTE: los datos de contacto están en este bloque. Reemplázalos por los reales. --}}
@php
    $correo = 'hola@ejj.pe';
    $telefono = '+51 987 654 321';
    $whatsapp = '51987654321'; // sin + ni espacios, para wa.me

    $tipos = [
        'demo' => 'Quiero ver una demostración',
        'precios' => 'Tengo dudas sobre los planes',
        'soporte' => 'Necesito soporte técnico',
        'otro' => 'Otra consulta',
    ];
@endphp

<x-public-layout title="Contacto">

    {{-- ===================================================== --}}
    {{-- 1. ENCABEZADO                                         --}}
    {{-- ===================================================== --}}
    <section class="relative overflow-hidden border-b border-slate-200/80 bg-surface">
        <div aria-hidden="true"
            class="pointer-events-none absolute -right-20 -top-28 h-80 w-80 rounded-full bg-primary/10 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-primary/25 bg-primary/10 px-3.5 py-1.5 text-xs font-semibold text-primary">
                    <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                    Contacto
                </span>

                <h1 class="mt-6 text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-950 sm:text-5xl">
                    Cuéntanos de tu<br>
                    <span class="text-primary">ferretería.</span>
                </h1>

                <p class="mt-6 text-base leading-relaxed text-slate-600 sm:text-[17px]">
                    Escríbenos y te responde alguien del equipo. Si EJJ. todavía no es lo que
                    necesitas, también te lo vamos a decir.
                </p>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 2. FORMULARIO + CANALES                                --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:gap-14">

                {{-- ---------- Formulario ---------- --}}
                <div class="lg:col-span-7">
                    <div
                        class="rounded-3xl border border-slate-100 bg-white p-7 shadow-[0_20px_50px_rgba(8,32,215,0.06)] sm:p-9">

                        {{-- Mensaje de éxito --}}
                        @if (session('status'))
                            <div
                                class="mb-7 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                                <span
                                    class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </span>
                                <p class="text-sm font-medium leading-relaxed text-emerald-800">
                                    {{ session('status') }}
                                </p>
                            </div>
                        @endif

                        {{-- Aviso general de errores --}}
                        @if ($errors->any())
                            <div class="mb-7 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4">
                                <span
                                    class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-500 text-white">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007" />
                                    </svg>
                                </span>
                                <p class="text-sm font-medium leading-relaxed text-red-800">
                                    Revisa los campos marcados y vuelve a enviar.
                                </p>
                            </div>
                        @endif

                        <h2 class="text-xl font-extrabold tracking-tight text-slate-950">Envíanos un mensaje</h2>
                        <p class="mt-2 text-sm text-slate-500">
                            Los campos con <span class="text-red-500">*</span> son obligatorios.
                        </p>

                        <form method="POST" action="{{ route('contacto.store') }}" class="mt-7 space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                {{-- Nombre --}}
                                <div>
                                    <x-input-label for="nombre">
                                        Tu nombre <span class="text-red-500">*</span>
                                    </x-input-label>
                                    <x-text-input id="nombre" name="nombre" type="text" :value="old('nombre')"
                                        placeholder="Juan Pérez" required autocomplete="name" />
                                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                                </div>

                                {{-- Ferretería --}}
                                <div>
                                    <x-input-label for="ferreteria" value="Nombre de tu ferretería" />
                                    <x-text-input id="ferreteria" name="ferreteria" type="text"
                                        :value="old('ferreteria')" placeholder="Ferretería El Tornillo"
                                        autocomplete="organization" />
                                    <x-input-error :messages="$errors->get('ferreteria')" class="mt-2" />
                                </div>

                                {{-- Correo --}}
                                <div>
                                    <x-input-label for="email">
                                        Correo electrónico <span class="text-red-500">*</span>
                                    </x-input-label>
                                    <x-text-input id="email" name="email" type="email" :value="old('email')"
                                        placeholder="nombre@ferreteria.com" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                {{-- Teléfono --}}
                                <div>
                                    <x-input-label for="telefono" value="Teléfono o WhatsApp" />
                                    <x-text-input id="telefono" name="telefono" type="tel" :value="old('telefono')"
                                        placeholder="987 654 321" autocomplete="tel" />
                                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Tipo de consulta --}}
                            <div>
                                <x-input-label for="tipo">
                                    ¿Sobre qué nos escribes? <span class="text-red-500">*</span>
                                </x-input-label>
                                <select id="tipo" name="tipo" required
                                    class="mt-1.5 block w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm text-slate-700 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="" disabled @selected(!old('tipo'))>Elige una opción</option>
                                    @foreach ($tipos as $clave => $etiqueta)
                                        <option value="{{ $clave }}" @selected(old('tipo') === $clave)>
                                            {{ $etiqueta }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                            </div>

                            {{-- Mensaje --}}
                            <div>
                                <x-input-label for="mensaje">
                                    Tu consulta <span class="text-red-500">*</span>
                                </x-input-label>
                                <textarea id="mensaje" name="mensaje" rows="5" required
                                    placeholder="Cuéntanos cómo llevas hoy tus ventas y tu inventario, y qué te gustaría resolver."
                                    class="mt-1.5 block w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm text-slate-700 shadow-sm focus:border-primary focus:ring-primary">{{ old('mensaje') }}</textarea>
                                <x-input-error :messages="$errors->get('mensaje')" class="mt-2" />
                            </div>

                            <div class="flex flex-col items-start gap-4 pt-1 sm:flex-row sm:items-center">
                                <x-primary-button class="w-full sm:w-auto">
                                    Enviar mensaje
                                    <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                    </svg>
                                </x-primary-button>

                                <p class="text-xs leading-relaxed text-slate-500">
                                    Usamos tus datos solo para responderte esta consulta.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ---------- Canales directos ---------- --}}
                <div class="lg:col-span-5">
                    <div class="space-y-4">

                        {{-- WhatsApp --}}
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener"
                            class="group flex items-start gap-4 rounded-2xl border border-slate-200/90 bg-white p-6 transition hover:border-primary/30 hover:shadow-[0_10px_30px_rgba(8,32,215,0.07)]">
                            <span
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-base font-bold tracking-tight text-slate-900">WhatsApp</h3>
                                <p class="mt-1 text-sm text-slate-600">{{ $telefono }}</p>
                                <p class="mt-2 text-xs font-semibold text-primary group-hover:underline">
                                    Es la vía más rápida →
                                </p>
                            </div>
                        </a>

                        {{-- Correo --}}
                        <a href="mailto:{{ $correo }}"
                            class="group flex items-start gap-4 rounded-2xl border border-slate-200/90 bg-white p-6 transition hover:border-primary/30 hover:shadow-[0_10px_30px_rgba(8,32,215,0.07)]">
                            <span
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-base font-bold tracking-tight text-slate-900">Correo</h3>
                                <p class="mt-1 text-sm text-slate-600">{{ $correo }}</p>
                                <p class="mt-2 text-xs font-semibold text-primary group-hover:underline">
                                    Escríbenos →
                                </p>
                            </div>
                        </a>

                        {{-- Horario --}}
                        <div class="rounded-2xl border border-slate-200/90 bg-slate-50/60 p-6">
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-primary">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="text-base font-bold tracking-tight text-slate-900">
                                        Horario de atención
                                    </h3>
                                    <dl class="mt-3 space-y-1.5 text-sm">
                                        <div class="flex justify-between gap-6">
                                            <dt class="text-slate-600">Lunes a viernes</dt>
                                            <dd class="font-semibold text-slate-800">9:00 – 18:00</dd>
                                        </div>
                                        <div class="flex justify-between gap-6">
                                            <dt class="text-slate-600">Sábados</dt>
                                            <dd class="font-semibold text-slate-800">9:00 – 13:00</dd>
                                        </div>
                                        <div class="flex justify-between gap-6">
                                            <dt class="text-slate-600">Domingos</dt>
                                            <dd class="font-semibold text-slate-500">Cerrado</dd>
                                        </div>
                                    </dl>
                                    <p class="mt-4 border-t border-slate-200/80 pt-3 text-xs leading-relaxed text-slate-500">
                                        Fuera de horario puedes escribirnos igual: respondemos al siguiente
                                        día hábil.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Atajo a FAQs --}}
                        <div class="rounded-2xl border border-primary/20 bg-primary/5 p-6">
                            <h3 class="text-base font-bold tracking-tight text-slate-900">
                                ¿Es una duda rápida?
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600">
                                Puede que ya esté contestada. Revisa las preguntas frecuentes antes
                                de esperar nuestra respuesta.
                            </p>
                            <a href="{{ route('faqs') }}"
                                class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-primary hover:gap-3 transition-all">
                                Ver preguntas frecuentes
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
