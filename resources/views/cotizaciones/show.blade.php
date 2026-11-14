<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ __('Cotización') }} {{ $cotizacion->codigo }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            @include('cotizaciones._alertas')

            <div class="rounded-xl border border-slate-200 bg-white p-6 space-y-5">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="text-xs text-slate-400">Cliente</p>
                        <p class="font-semibold text-slate-800">{{ $cotizacion->cliente_nombre }}</p>
                        <p class="text-xs text-slate-500">
                            {{ $cotizacion->cliente_documento ?: 'Sin documento' }}
                            @if ($cotizacion->cliente_contacto) · {{ $cotizacion->cliente_contacto }} @endif
                        </p>
                    </div>
                    <div class="text-right text-sm text-slate-500">
                        <p>{{ $cotizacion->created_at->format('d/m/Y H:i') }}</p>
                        <p>Vendedor: {{ $cotizacion->vendedor->name }}</p>
                        <p class="mt-1">
                            @if ($cotizacion->estado === 'pagada')
                                <span class="rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">Pagada</span>
                            @else
                                <span class="rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">Borrador</span>
                            @endif
                        </p>
                    </div>
                </div>

                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-3 py-2">Código</th>
                            <th class="px-3 py-2">Producto</th>
                            <th class="px-3 py-2 text-right">Cant.</th>
                            <th class="px-3 py-2 text-right">P. unitario</th>
                            <th class="px-3 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($cotizacion->detalles as $d)
                            <tr>
                                <td class="px-3 py-2 text-slate-500">{{ $d->producto->codigo }}</td>
                                <td class="px-3 py-2 font-medium text-slate-800">{{ $d->producto->nombre }}</td>
                                <td class="px-3 py-2 text-right">{{ $d->cantidad }}</td>
                                <td class="px-3 py-2 text-right">S/ {{ number_format($d->precio, 2) }}</td>
                                <td class="px-3 py-2 text-right">S/ {{ number_format($d->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <dl class="ml-auto w-full max-w-xs space-y-1 text-sm">
                    <div class="flex justify-between"><dt class="text-slate-500">Subtotal</dt><dd>S/ {{ number_format($cotizacion->subtotal, 2) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Descuento</dt><dd>-S/ {{ number_format($cotizacion->descuento, 2) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Envío</dt><dd>S/ {{ number_format($cotizacion->envio, 2) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">IGV (18 %)</dt><dd>S/ {{ number_format($cotizacion->igv, 2) }}</dd></div>
                    <div class="flex justify-between border-t border-slate-200 pt-2 text-base font-bold">
                        <dt>Total</dt><dd class="text-[var(--color-primary)]">S/ {{ number_format($cotizacion->total, 2) }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.cotizaciones.index') }}"
                    class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Volver al listado</a>

                @if ($cotizacion->estado === 'borrador')
                    <a href="{{ route('admin.cotizaciones.pago', $cotizacion) }}"
                        class="rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90">Continuar al pago →</a>
                @else
                    <a href="{{ route('admin.cotizaciones.orden', $cotizacion) }}"
                        class="rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90">Ver orden de venta</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
