<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.cotizaciones.show', $cotizacion) }}" class="text-slate-600 hover:text-slate-900 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ __('Cotizaciones') }}</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <form method="POST" action="{{ route('admin.cotizaciones.pago.confirmar', $cotizacion) }}"
            x-data="pago({{ Js::from($metodos) }}, {{ (float) $cotizacion->total }})"
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            @csrf

            <div>
                <h1 class="text-2xl font-bold text-slate-900">Procesar pago</h1>
                <p class="text-sm text-slate-500">Selecciona un método y registra el pago de la operación.</p>
                <div class="mt-3">@include('cotizaciones._pasos', ['paso' => 2])</div>
            </div>

            @include('cotizaciones._alertas')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">
                <div class="lg:col-span-2 space-y-5">

                    {{-- Resumen de la cotización --}}
                    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-slate-400">Cotización</p>
                                <p class="text-lg font-bold text-slate-900">{{ $cotizacion->codigo }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-800">{{ $cotizacion->cliente_nombre }}</p>
                                <p class="text-xs text-slate-400">DNI / RUC {{ $cotizacion->cliente_documento ?: '—' }}</p>
                            </div>
                        </div>

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
                    </section>

                    {{-- Método de pago --}}
                    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4">
                        <h3 class="text-sm font-bold text-slate-800">Método de pago</h3>

                        @if ($metodos->isEmpty())
                            <p class="rounded-lg bg-amber-50 border border-amber-200 px-4 py-3 text-sm text-amber-700">
                                No hay métodos de pago registrados. Ejecuta el seeder o crea uno en el módulo Métodos de pago.
                            </p>
                        @endif

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @foreach ($metodos as $m)
                                <label class="cursor-pointer">
                                    <input type="radio" name="metodo_pago_id" value="{{ $m->id }}" class="peer sr-only"
                                        x-model="metodoId" required>
                                    <div class="rounded-xl border border-slate-200 px-3 py-5 text-center text-xs font-medium text-slate-600
                                                peer-checked:border-[var(--color-primary)] peer-checked:bg-blue-50 peer-checked:text-[var(--color-primary)]">
                                        {{ $m->nombre }}
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        {{-- Solo para efectivo --}}
                        <div x-show="esEfectivo" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Monto recibido (S/)</label>
                                <input type="number" step="0.01" min="0" name="monto_recibido" x-model.number="recibido"
                                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                            </div>
                            <div class="rounded-lg bg-slate-50 px-4 py-2">
                                <p class="text-xs text-slate-400">Vuelto</p>
                                <p class="text-lg font-bold" x-text="'S/ ' + vuelto.toFixed(2)"></p>
                            </div>
                        </div>

                        <div class="rounded-lg bg-amber-50 border border-amber-200 px-4 py-3 text-xs text-amber-800">
                            <strong>Pago simulado.</strong> No se consulta ninguna entidad financiera ni se verifica una transferencia real. No envíes dinero.
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.cotizaciones.show', $cotizacion) }}"
                                class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Volver a cotización</a>
                            <button type="submit"
                                class="rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90">✓ Confirmar pago</button>
                            <a href="{{ route('admin.cotizaciones.index') }}" class="text-xs text-slate-400 hover:text-slate-600">Cancelar operación</a>
                        </div>
                    </section>
                </div>

                {{-- Importe de la operación --}}
                <aside class="rounded-xl border border-slate-200 bg-white p-5 space-y-3 lg:sticky lg:top-20">
                    <h3 class="text-sm font-bold text-slate-800">Importe de la operación</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between"><dt class="text-slate-500">Subtotal</dt><dd>S/ {{ number_format($cotizacion->subtotal, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Descuento</dt><dd>-S/ {{ number_format($cotizacion->descuento, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Envío</dt><dd>S/ {{ number_format($cotizacion->envio, 2) }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">IGV (18 %)</dt><dd>S/ {{ number_format($cotizacion->igv, 2) }}</dd></div>
                        <div class="flex justify-between border-t border-slate-200 pt-3 text-base font-bold">
                            <dt>Total</dt><dd class="text-[var(--color-primary)]">S/ {{ number_format($cotizacion->total, 2) }}</dd>
                        </div>
                    </dl>
                    <p class="text-[11px] text-slate-400">El total ya incluye IGV.</p>
                </aside>
            </div>
        </form>
    </div>

    <script>
        function pago(metodos, total) {
            return {
                metodos: metodos,
                total: total,
                metodoId: '',
                recibido: '',

                get esEfectivo() {
                    const m = this.metodos.find(x => x.id == this.metodoId);
                    return m ? m.nombre.toLowerCase() === 'efectivo' : false;
                },
                get vuelto() {
                    return Math.max((Number(this.recibido) || 0) - this.total, 0);
                },
            };
        }
    </script>
</x-app-layout>
