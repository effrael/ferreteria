@php
    $lista = $usuarios ?? $users;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            <!-- Alertas de sesión y validación -->
            @if (session('success'))
                <div class="rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <p class="font-semibold mb-1">Por favor corrige los siguientes errores:</p>
                    <ul class="list-disc pl-5 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Barra superior: Buscador + Botón Crear Cliente -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <form method="GET" action="{{ route('admin.usuarios.index') }}" class="relative flex-1 max-w-5xl">
                    <button type="submit" aria-label="Buscar"
                        class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 hover:text-slate-600 transition cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>

                    <input type="search" name="buscar" value="{{ request('buscar') }}"
                        placeholder="Buscar cliente por nombre, documento o correo..."
                        class="block w-full rounded-lg border border-slate-200 bg-white py-2 pl-10 pr-10 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">

                    @if (request('buscar'))
                        <a href="{{ route('admin.usuarios.index') }}" aria-label="Limpiar búsqueda"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </form>

                <div class="shrink-0">
                    <a href="{{ route('admin.usuarios.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Crear Cliente</span>
                    </a>
                </div>
            </div>

            <!-- Contenedor de la Tabla -->
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200/80 text-left text-sm">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-6 pr-3 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    N°
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Documento
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Teléfono
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Correo
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Estado
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-6 text-right">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($lista as $item)
                                <tr class="odd:bg-slate-50/70 even:bg-white hover:bg-slate-100/70 transition-colors">
                                    <td class="whitespace-nowrap py-3.5 pl-6 pr-3 text-[13px] text-slate-700">
                                        {{ $lista->firstItem() + $loop->index }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] font-medium text-slate-800">
                                        {{ $item->name }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        {{ $item->documento ?? '—' }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        {{ $item->telefono ?? '—' }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        {{ $item->email ?? '—' }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px]">
                                        @if ($item->estado)
                                            <span
                                                class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-700">
                                                Activo
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>

                                    <td
                                        class="whitespace-nowrap py-3.5 pl-3 pr-6 text-right text-sm font-medium space-x-1 flex justify-end">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('admin.usuarios.edit', $item) }}"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-[var(--color-primary)] hover:bg-slate-200/70 transition cursor-pointer">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <span>Editar</span>
                                        </a>

                                        <!-- Botón Activar / Desactivar -->
                                        <form action="{{ route('admin.usuarios.destroy', $item) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm({{ Js::from(($item->estado ? '¿Desactivar' : '¿Activar') . ' al cliente ' . $item->name . '?') }})"
                                            @csrf
                                            @method('DELETE')
                                            @if ($item->estado)
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-red-600 hover:bg-red-50 transition cursor-pointer">
                                                    Desactivar
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-emerald-600 hover:bg-emerald-50 transition cursor-pointer">
                                                    Activar
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center text-sm text-slate-400">
                                        @if (request('buscar'))
                                            No se encontraron clientes para «{{ request('buscar') }}».
                                        @else
                                            Aún no hay clientes registrados.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pie de la tabla: conteo + paginación -->
                @if ($lista->total() > 0)
                    <div
                        class="flex flex-col gap-3 border-t border-slate-200/80 bg-slate-50/60 px-6 py-3.5 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-slate-500">
                            Mostrando
                            <span class="font-semibold text-slate-700">{{ $lista->firstItem() }}</span>–<span
                                class="font-semibold text-slate-700">{{ $lista->lastItem() }}</span>
                            de <span class="font-semibold text-slate-700">{{ $lista->total() }}</span>
                            clientes
                        </p>

                        @if ($lista->hasPages())
                            <div class="[&_nav]:m-0!">
                                {{ $lista->onEachSide(1)->links() }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>