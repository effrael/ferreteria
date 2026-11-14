<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Métodos de Pago') }}
            </h2>
            <a href="{{ route('admin.metodos-pago.create') }}"
               class="rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition">
                + Nuevo método de pago
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Buscador --}}
            <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
                <form method="GET" action="{{ route('admin.metodos-pago.index') }}" class="flex gap-2">
                    <input type="search" name="buscar" value="{{ request('buscar') }}"
                           placeholder="Buscar por nombre..."
                           class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                    <button type="submit"
                            class="rounded-lg border border-[var(--color-primary)] bg-white px-4 py-2 text-sm font-semibold text-[var(--color-primary)] hover:bg-slate-50 transition cursor-pointer">
                        Buscar
                    </button>
                </form>
                <p class="text-sm text-slate-500">
                    {{ $metodosPago->total() }} registros encontrados.
                </p>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto bg-white rounded-xl border border-slate-200/90 shadow-2xs">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">N°</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($metodosPago as $item)
                            <tr @class([
                                'hover:bg-slate-50/70 transition',
                                'text-slate-400 bg-slate-50/40' => ! $item->estado,
                            ])>
                                <td class="px-4 py-3">
                                    {{ $metodosPago->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-800">
                                    {{ $item->nombre }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $item->descripcion ?? '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span @class([
                                        'inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold',
                                        'bg-emerald-100 text-emerald-700' => $item->estado,
                                        'bg-slate-200 text-slate-600' => ! $item->estado,
                                    ])>
                                        {{ $item->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="{{ route('admin.metodos-pago.edit', $item) }}"
                                           class="font-medium text-[var(--color-primary)] hover:underline">
                                            Editar
                                        </a>

                                        @if ($item->estado)
                                            <form method="POST"
                                                  action="{{ route('admin.metodos-pago.destroy', $item) }}"
                                                  onsubmit="return confirm('¿Desactivar el método de pago «{{ $item->nombre }}»?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="font-medium text-red-600 hover:underline cursor-pointer">
                                                    Desactivar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                                    No se encontraron métodos de pago.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $metodosPago->links() }}
            </div>

        </div>
    </div>
</x-app-layout>