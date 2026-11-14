<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.cotizaciones.index') }}" class="text-slate-600 hover:text-slate-900 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">{{ __('Cotizaciones') }}</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <form method="POST" action="{{ route('admin.cotizaciones.store') }}"
            x-data="cotizador({{ Js::from($productos) }})"
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            @csrf

            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-[var(--color-primary)]">Vendedor</p>
                <h1 class="text-2xl font-bold text-slate-900">Generar cotización</h1>
                <p class="text-sm text-slate-500">Prepara una propuesta para tu cliente. · {{ $codigo }}</p>
                <div class="mt-3">@include('cotizaciones._pasos', ['paso' => 1])</div>
            </div>

            @include('cotizaciones._alertas')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">

                {{-- ============ COLUMNA IZQUIERDA ============ --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- 01. Información del cliente --}}
                    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4">
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">01. Información del cliente</h3>
                            <p class="text-xs text-slate-400">Escribe los datos del cliente o déjalo como público general.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">DNI / RUC</label>
                                <div class="flex gap-2">
                                    <input type="text" name="cliente_documento" maxlength="20" value="{{ old('cliente_documento') }}"
                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700">
                                    {{-- Se activará cuando exista el módulo Clientes --}}
                                    <button type="button" disabled title="Disponible cuando exista el módulo Clientes"
                                        class="shrink-0 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-400 cursor-not-allowed">
                                        Buscar cliente
                                    </button>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nombre o razón social</label>
                                <input type="text" name="cliente_nombre" maxlength="150" value="{{ old('cliente_nombre') }}"
                                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Información de contacto</label>
                            <input type="text" name="cliente_contacto" maxlength="150" value="{{ old('cliente_contacto') }}"
                                placeholder="Teléfono o correo electrónico"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 placeholder-slate-400">
                        </div>
                    </section>

                    {{-- 02. Agregar productos --}}
                    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4">
                        <h3 class="text-sm font-bold text-slate-800">02. Agregar productos</h3>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Buscar por código o nombre</label>
                            <input type="text" x-model="busqueda" placeholder="Ej. martillo o MAR-001"
                                @keydown.enter.prevent="agregar()"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 placeholder-slate-400">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Producto</label>
                                <select x-model="seleccionado"
                                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700">
                                    <template x-for="p in filtrados" :key="p.id">
                                        <option :value="p.id" x-text="p.nombre"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Cantidad solicitada</label>
                                <input type="number" min="1" x-model.number="cantidad"
                                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700">
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <p class="text-xs text-slate-500" x-show="actual">
                                S/ <span x-text="actual ? parseFloat(actual.precioventa).toFixed(2) : ''"></span> / unidad ·
                                Stock disponible: <span x-text="actual ? disponible(actual) : ''"></span>
                            </p>
                            <p class="text-xs text-slate-400" x-show="!actual">No hay productos que coincidan.</p>

                            <button type="button" @click="agregar()" :disabled="!actual"
                                class="shrink-0 rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90 disabled:opacity-40">
                                + Agregar producto
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-400">Precios unitarios sin IGV. El impuesto se agrega solo en el resumen.</p>
                    </section>

                    {{-- Productos seleccionados --}}
                    <section class="rounded-xl border border-slate-200 bg-white p-5">
                        <h3 class="text-sm font-bold text-slate-800 mb-3">Productos seleccionados</h3>

                        <p x-show="items.length === 0" class="py-6 text-center text-sm text-slate-400">
                            Todavía no agregaste productos.
                        </p>

                        <div x-show="items.length > 0" class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-left text-xs uppercase text-slate-500">
                                    <tr>
                                        <th class="py-2">Producto</th>
                                        <th class="py-2 text-right">Cant.</th>
                                        <th class="py-2 text-right">P. unitario</th>
                                        <th class="py-2 text-right">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <template x-for="(it, i) in items" :key="it.producto_id">
                                        <tr>
                                            <td class="py-2 font-medium text-slate-800" x-text="it.nombre"></td>
                                            <td class="py-2 text-right" x-text="it.cantidad"></td>
                                            <td class="py-2 text-right" x-text="'S/ ' + it.precio.toFixed(2)"></td>
                                            <td class="py-2 text-right" x-text="'S/ ' + (it.precio * it.cantidad).toFixed(2)"></td>
                                            <td class="py-2 text-right">
                                                <button type="button" @click="quitar(i)" class="text-xs text-red-600 hover:underline">Quitar</button>
                                                {{-- Estos inputs ocultos son los que viajan al servidor --}}
                                                <input type="hidden" :name="`items[${i}][producto_id]`" :value="it.producto_id">
                                                <input type="hidden" :name="`items[${i}][cantidad]`" :value="it.cantidad">
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                {{-- ============ COLUMNA DERECHA: RESUMEN ============ --}}
                <aside class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 lg:sticky lg:top-20">
                    <h3 class="text-sm font-bold text-slate-800">Resumen de cotización</h3>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Descuento (S/)</label>
                            <input type="number" step="0.01" min="0" name="descuento" x-model.number="descuento"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Envío (S/)</label>
                            <input type="number" step="0.01" min="0" name="envio" x-model.number="envio"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                        </div>
                    </div>

                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between"><dt class="text-slate-500">Subtotal</dt><dd x-text="'S/ ' + subtotal.toFixed(2)"></dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Descuento</dt><dd x-text="'-S/ ' + desc.toFixed(2)"></dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Envío</dt><dd x-text="'S/ ' + env.toFixed(2)"></dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">IGV (18 %)</dt><dd x-text="'S/ ' + igv.toFixed(2)"></dd></div>
                        <div class="flex justify-between border-t border-slate-200 pt-3 text-base font-bold">
                            <dt>Total</dt>
                            <dd class="text-[var(--color-primary)]" x-text="'S/ ' + total.toFixed(2)"></dd>
                        </div>
                    </dl>

                    <p class="text-[11px] text-slate-400">IGV: 18 % sobre productos menos descuento. Descuento expresado en soles.</p>

                    <div class="space-y-2">
                        <button type="button" @click="calcular()"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                            Calcular cotización
                        </button>
                        <button type="submit" name="accion" value="guardar" :disabled="items.length === 0"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 disabled:opacity-40">
                            Guardar cotización
                        </button>
                        <button type="submit" name="accion" value="pago" :disabled="items.length === 0"
                            class="w-full rounded-lg bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:opacity-90 disabled:opacity-40">
                            Continuar al pago →
                        </button>
                        <a href="{{ route('admin.cotizaciones.index') }}" class="block text-center text-xs text-slate-400 hover:text-slate-600">Cancelar</a>
                    </div>
                </aside>
            </div>
        </form>
    </div>

    <script>
        function cotizador(productos) {
            return {
                productos: productos,
                busqueda: '',
                seleccionado: '',
                cantidad: 1,
                items: [],
                descuento: 0,
                envio: 0,

                init() {
                    this.seleccionado = this.filtrados[0] ? this.filtrados[0].id : '';
                    // Al escribir en el buscador, se selecciona el primer resultado.
                    this.$watch('busqueda', () => {
                        this.seleccionado = this.filtrados[0] ? this.filtrados[0].id : '';
                    });
                },

                get filtrados() {
                    const q = this.busqueda.toLowerCase().trim();
                    return this.productos.filter(p =>
                        q === '' ||
                        (p.nombre && p.nombre.toLowerCase().includes(q)) ||
                        (p.codigo && p.codigo.toLowerCase().includes(q))
                    );
                },

                get actual() {
                    return this.productos.find(p => p.id == this.seleccionado) || null;
                },

                // Stock menos lo que ya agregaste a la lista.
                disponible(p) {
                    const ya = this.items.find(i => i.producto_id === p.id);
                    return p.stock - (ya ? ya.cantidad : 0);
                },

                agregar() {
                    const p = this.actual;
                    const cant = parseInt(this.cantidad) || 0;
                    if (!p || cant < 1) return;

                    if (cant > this.disponible(p)) {
                        alert('Stock insuficiente. Disponible: ' + this.disponible(p));
                        return;
                    }

                    const ya = this.items.find(i => i.producto_id === p.id);
                    if (ya) {
                        ya.cantidad += cant;
                    } else {
                        this.items.push({
                            producto_id: p.id,
                            nombre: p.nombre,
                            precio: parseFloat(p.precioventa),
                            cantidad: cant,
                        });
                    }
                    this.cantidad = 1;
                },

                quitar(i) { this.items.splice(i, 1); },

                get subtotal() { return this.items.reduce((s, i) => s + i.precio * i.cantidad, 0); },
                get desc() { return Math.min(Math.max(Number(this.descuento) || 0, 0), this.subtotal); },
                get env() { return Math.max(Number(this.envio) || 0, 0); },
                get igv() { return (this.subtotal - this.desc) * 0.18; },
                get total() { return this.subtotal - this.desc + this.env + this.igv; },

                // Corrige valores inválidos (negativos, descuento mayor al subtotal).
                calcular() {
                    this.descuento = this.desc;
                    this.envio = this.env;
                },
            };
        }
    </script>
</x-app-layout>
