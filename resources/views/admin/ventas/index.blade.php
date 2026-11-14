{{-- SIMULACIÓN DE INTERFAZ: los datos están escritos a mano en el array $ventas. --}}
{{-- Todavía no lee de la base de datos. --}}

@php
    $ventas = [
        ['sunat' => false, 'fecha' => '12-11-2026', 'doc' => '00000000',    'cliente' => null,                      'serie' => 'NV17', 'numero' => '228',       'total' => '80.00'],
        ['sunat' => false, 'fecha' => '07-11-2026', 'doc' => '00000000',    'cliente' => null,                      'serie' => 'NV17', 'numero' => '227',       'total' => '0.26'],
        ['sunat' => true,  'fecha' => '02-11-2026', 'doc' => '20000000001', 'cliente' => 'FERRETERÍA DEMO S.A.C.',  'serie' => 'F001', 'numero' => '8593',      'total' => '960.00'],
        ['sunat' => true,  'fecha' => '02-11-2026', 'doc' => '20000000001', 'cliente' => 'FERRETERÍA DEMO S.A.C.',  'serie' => 'F001', 'numero' => '8592',      'total' => '960.00'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'CONSTRUCTORA LOS ANDES',  'serie' => 'B001', 'numero' => '314430003', 'total' => '1.25'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'CONSTRUCTORA LOS ANDES',  'serie' => 'B001', 'numero' => '314430002', 'total' => '1.25'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'MAESTRO OBRA - GRATIS',   'serie' => 'B002', 'numero' => '1223',      'total' => '2.00'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'MAESTRO OBRA - DESCUENTO','serie' => 'B002', 'numero' => '1222',      'total' => '2.50'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'MAESTRO OBRA - ANTICIPO', 'serie' => 'B002', 'numero' => '1221',      'total' => '1.00'],
        ['sunat' => true,  'fecha' => '01-11-2026', 'doc' => '10203040506', 'cliente' => 'GASFITERÍA EL TUBO E.I.R.L.', 'serie' => 'F002', 'numero' => '8',     'total' => '3.00'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'MAESTRO OBRA - BOLETA',   'serie' => 'B002', 'numero' => '1220',      'total' => '3.00'],
        ['sunat' => true,  'fecha' => '01-11-2026', 'doc' => '10203040506', 'cliente' => 'GASFITERÍA EL TUBO E.I.R.L.', 'serie' => 'F001', 'numero' => '8591',  'total' => '1.00'],
        ['sunat' => false, 'fecha' => '01-11-2026', 'doc' => '00000000',    'cliente' => 'VENTA MOSTRADOR',         'serie' => 'B001', 'numero' => '314430001', 'total' => '1.00'],
    ];

    $periodos = ['Diario', 'Semanal', 'Mensual', 'Anual'];
@endphp

<x-app-layout>
    <x-slot name="header">
        {{ __('Ventas') }}
    </x-slot>

    <div class="py-6" x-data="{ periodo: 'Mensual', search: '', menu: null }">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ============================================== --}}
            {{-- Barra 1: periodos + total + navegación de mes  --}}
            {{-- ============================================== --}}
            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">

                {{-- Píldoras de periodo --}}
                <div class="flex items-center gap-2 overflow-x-auto pb-1 xl:pb-0">
                    @foreach ($periodos as $p)
                        <button type="button" @click="periodo = '{{ $p }}'"
                            :class="periodo === '{{ $p }}'
                                ? 'bg-primary/10 border-primary/30 text-primary font-semibold'
                                : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'"
                            class="shrink-0 rounded-full border px-4 py-1.5 text-xs transition cursor-pointer">
                            {{ $p }}
                        </button>
                    @endforeach
                </div>

                {{-- Total del periodo + selector de mes --}}
                <div class="flex flex-wrap items-center gap-x-5 gap-y-3">

                    {{-- Total --}}
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        <span class="text-sm font-bold tracking-tight text-slate-900">S/ 2,016.26</span>
                    </div>

                    <span class="hidden h-5 w-px bg-slate-200 sm:block"></span>

                    {{-- Mes actual --}}
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span class="text-sm font-medium text-slate-700">Nov 2026</span>
                    </div>

                    {{-- Navegación entre meses --}}
                    <div class="flex items-center gap-1">
                        <button type="button" aria-label="Mes anterior"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition cursor-pointer">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <button type="button"
                            class="rounded-lg px-3 py-1.5 text-xs font-medium text-slate-500 hover:bg-slate-100 transition cursor-pointer">
                            Oct
                        </button>
                        <button type="button"
                            class="rounded-lg bg-primary/10 px-3 py-1.5 text-xs font-bold text-primary cursor-pointer">
                            Nov
                        </button>
                        <button type="button"
                            class="rounded-lg px-3 py-1.5 text-xs font-medium text-slate-500 hover:bg-slate-100 transition cursor-pointer">
                            Dic
                        </button>

                        <button type="button" aria-label="Mes siguiente"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition cursor-pointer">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- Barra 2: buscador + crear venta                --}}
            {{-- ============================================== --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <div class="relative flex-1 max-w-5xl">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" x-model="search" placeholder="Buscar comprobante por cliente, serie o número..."
                        class="block w-full rounded-lg border border-slate-200 bg-white py-2 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div class="shrink-0">
                    <a href="{{ route('admin.vender.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.4"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Crear venta
                    </a>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- Tabla de comprobantes                          --}}
            {{-- ============================================== --}}
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200/80 text-left text-sm">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-6 pr-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500 whitespace-nowrap">
                                    SUNAT
                                </th>
                                @foreach (['F. Emisión', 'Doc. Cliente', 'Cliente', 'Serie', 'Número'] as $titulo)
                                    <th scope="col"
                                        class="px-3 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-500 whitespace-nowrap">
                                        {{ $titulo }}
                                    </th>
                                @endforeach
                                <th scope="col"
                                    class="px-3 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500 whitespace-nowrap">
                                    Total
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-6 text-right">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($ventas as $i => $venta)
                                <tr x-show="search === '' || '{{ strtolower(($venta['cliente'] ?? '') . ' ' . $venta['serie'] . ' ' . $venta['numero']) }}'.includes(search.toLowerCase())"
                                    class="odd:bg-slate-50/70 even:bg-white hover:bg-slate-100/70 transition-colors">

                                    {{-- Estado SUNAT --}}
                                    <td class="whitespace-nowrap py-3.5 pl-6 pr-3 text-[13px]">
                                        <span class="inline-flex items-center gap-2">
                                            <span
                                                class="h-2.5 w-2.5 shrink-0 rounded-full {{ $venta['sunat'] ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                            <span class="{{ $venta['sunat'] ? 'text-slate-700' : 'text-slate-500' }}">
                                                {{ $venta['sunat'] ? 'Enviado' : 'No enviado' }}
                                            </span>
                                        </span>
                                    </td>

                                    {{-- Fecha de emisión --}}
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700">
                                        {{ $venta['fecha'] }}
                                    </td>

                                    {{-- Documento del cliente --}}
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600 tabular-nums">
                                        {{ $venta['doc'] }}
                                    </td>

                                    {{-- Cliente --}}
                                    <td class="px-3 py-3.5 text-[13px] max-w-sm truncate">
                                        @if ($venta['cliente'])
                                            <span class="font-medium text-primary">{{ $venta['cliente'] }}</span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>

                                    {{-- Serie --}}
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px]">
                                        <span
                                            class="inline-flex items-center rounded-md border border-slate-200 bg-slate-50 px-2 py-0.5 text-xs font-semibold text-slate-600">
                                            {{ $venta['serie'] }}
                                        </span>
                                    </td>

                                    {{-- Número --}}
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700 tabular-nums">
                                        {{ $venta['numero'] }}
                                    </td>

                                    {{-- Total --}}
                                    <td
                                        class="whitespace-nowrap px-3 py-3.5 text-right text-[13px] font-semibold text-slate-900 tabular-nums">
                                        S/ {{ $venta['total'] }}
                                    </td>

                                    {{-- Acciones --}}
                                    <td class="relative whitespace-nowrap py-3.5 pl-3 pr-6 text-right text-[13px]">
                                        <button type="button" @click="menu = menu === {{ $i }} ? null : {{ $i }}"
                                            @click.outside="menu === {{ $i }} && (menu = null)"
                                            aria-label="Acciones del comprobante"
                                            :class="menu === {{ $i }} ? 'bg-slate-200 text-slate-700' : 'text-slate-400'"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg hover:bg-slate-200 hover:text-slate-700 transition cursor-pointer">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="5" cy="12" r="1.8" />
                                                <circle cx="12" cy="12" r="1.8" />
                                                <circle cx="19" cy="12" r="1.8" />
                                            </svg>
                                        </button>

                                        {{-- Menú desplegable --}}
                                        <div x-show="menu === {{ $i }}" x-cloak
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            class="absolute right-6 z-20 mt-1 w-44 origin-top-right rounded-xl border border-slate-200 bg-white py-1.5 text-left shadow-lg">
                                            @foreach ([['Ver detalle', 'M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z'], ['Imprimir', 'M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5z']] as $accion)
                                                <button type="button"
                                                    class="flex w-full items-center gap-2.5 px-3.5 py-2 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition cursor-pointer">
                                                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.7" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="{{ $accion[1] }}" />
                                                    </svg>
                                                    {{ $accion[0] }}
                                                </button>
                                            @endforeach

                                            <div class="my-1.5 h-px bg-slate-100"></div>

                                            <button type="button"
                                                class="flex w-full items-center gap-2.5 px-3.5 py-2 text-[13px] text-red-600 hover:bg-red-50 transition cursor-pointer">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Anular venta
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-16 text-center text-sm text-slate-400">
                                        No hay comprobantes registrados en este periodo.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pie de la tabla --}}
                <div
                    class="flex flex-col gap-3 border-t border-slate-200/80 bg-slate-50/60 px-6 py-3.5 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-slate-500">
                        Mostrando <span class="font-semibold text-slate-700">{{ count($ventas) }}</span>
                        comprobantes de noviembre 2026
                    </p>
                    <div class="flex items-center gap-2">
                        <button type="button" disabled
                            class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-400 disabled:cursor-not-allowed">
                            Anterior
                        </button>
                        <button type="button"
                            class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 transition cursor-pointer">
                            Siguiente
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
