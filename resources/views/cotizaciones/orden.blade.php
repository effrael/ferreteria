@php $venta = $cotizacion->venta; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ __('Cotizaciones') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">Orden de venta registrada</h1>
                <p class="text-sm text-slate-500">La operación se completó correctamente en este prototipo.</p>
                <div class="mt-3">@include('cotizaciones._pasos', ['paso' => 3])</div>
            </div>

            <div class="rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                <p class="font-semibold">✓ Venta registrada · Inventario actualizado</p>
                <p class="text-xs">Las cantidades vendidas fueron descontadas del stock.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">
                <div class="lg:col-span-2 space-y-5">

                    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4">
                        <div class="flex justify-between items-start">
                            <p class="text-lg font-bold text-slate-900">{{ $venta->numero }}</p>
                            <span class="rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">Pagado</span>
                        </div>

                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div><dt class="text-xs text-slate-400">Fecha de venta</dt><dd class="font-medium">{{ $venta->created_at->format('d/m/Y, h:i a') }}</dd></div>
                            <div><dt class="text-xs text-slate-400">Cliente</dt><dd class="font-medium">{{ $cotizacion->cliente_nombre }}</dd></div>
                            <div><dt class="text-xs text-slate-400">Vendedor responsable</dt><dd class="font-medium">{{ $venta->vendedor->name }}</dd></div>
                            <div><dt class="text-xs text-slate-400">Método de pago</dt><dd class="font-medium">{{ $venta->metodo_pago }}</dd></div>
                            <div><dt class="text-xs text-slate-400">Cotización</dt><dd class="font-medium">{{ $cotizacion->codigo }}</dd></div>
                            <div><dt class="text-xs text-slate-400">Verificación</dt><dd class="font-medium">Simulada · no verificada por un banco</dd></div>
                        </dl>
                    </section>

                    <section class="rounded-xl border border-slate-200 bg-white p-5">
                        <h3 class="text-sm font-bold text-slate-800 mb-3">Detalle de productos</h3>
                        <table class="min-w-full text-sm">
                            <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                                <tr>
                                    <th class="px-3 py-2">Código</th>
                                    <th class="px-3 py-2">Producto</th>
                                    <th class="px-3 py-2 text-right">Cantidad</th>
                                    <th class="px-3 py-2 text-right">P. unitario</th>
                                    <th class="px-3 py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($venta->detalles()->with('producto')->get() as $d)
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
                    </section>

                    <div class="flex flex-wrap items-center gap-3 print:hidden">
                        <button type="button" onclick="window.print()"
                            class="rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90">Imprimir resumen</button>
                        <a href="{{ route('admin.cotizaciones.create') }}"
                            class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Nueva venta</a>
                        <a href="{{ route('dashboard') }}"
                            class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Volver al dashboard</a>
                    </div>
                </div>

                <aside class="rounded-xl border border-slate-200 bg-white p-5 space-y-3 lg:sticky lg:top-20">
                    <h3 class="text-sm font-bold text-slate-800">Resumen financiero</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between"><dt class="text-slate-500">Subtotal</dt><dd>S/ {{ number_format($venta->subtotal, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Descuento</dt><dd>-S/ {{ number_format($venta->descuento, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Envío</dt><dd>S/ {{ number_format($venta->envio, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">IGV (18 %)</dt><dd>S/ {{ number_format($venta->igv, 2) }}</dd></div>
                        <div class="flex justify-between border-t border-slate-200 pt-3 text-base font-bold">
                            <dt>Total</dt><dd class="text-[var(--color-primary)]">S/ {{ number_format($venta->total, 2) }}</dd>
                        </div>
                        <div class="flex justify-between pt-2"><dt class="text-slate-500">Monto recibido</dt><dd>S/ {{ number_format($venta->monto_recibido, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Vuelto</dt><dd>S/ {{ number_format($venta->vuelto, 2) }}</dd></div>
                        <div class="flex justify-between font-semibold"><dt>Total pagado</dt><dd>S/ {{ number_format($venta->total, 2) }}</dd></div>
                    </dl>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
