<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ __('Cotizaciones') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            @include('cotizaciones._alertas')

            <div class="flex items-center justify-between">
                <p class="text-sm text-slate-500">Propuestas preparadas para tus clientes.</p>
                <a href="{{ route('admin.cotizaciones.create') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90 transition">
                    + Nueva cotización
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Cliente</th>
                            <th class="px-4 py-3">Vendedor</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($cotizaciones as $c)
                            <tr>
                                <td class="px-4 py-3 font-semibold text-slate-800">{{ $c->codigo }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $c->cliente_nombre }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $c->vendedor->name }}</td>
                                <td class="px-4 py-3 text-right font-semibold">S/ {{ number_format($c->total, 2) }}</td>
                                <td class="px-4 py-3">
                                    @if ($c->estado === 'pagada')
                                        <span class="rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">Pagada</span>
                                    @else
                                        <span class="rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">Borrador</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right space-x-3">
                                    <a href="{{ route('admin.cotizaciones.show', $c) }}" class="text-[var(--color-primary)] hover:underline">Ver</a>
                                    @if ($c->estado === 'borrador')
                                        <a href="{{ route('admin.cotizaciones.pago', $c) }}" class="text-emerald-600 hover:underline">Cobrar</a>
                                        <form method="POST" action="{{ route('admin.cotizaciones.destroy', $c) }}" class="inline"
                                            onsubmit="return confirm('¿Eliminar la cotización {{ $c->codigo }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-slate-400">Aún no hay cotizaciones.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $cotizaciones->links() }}
        </div>
    </div>
</x-app-layout>
