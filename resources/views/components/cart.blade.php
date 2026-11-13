<!-- resources/views/components/cart.blade.php -->
<!-- ========================================================= -->
<!-- COLUMNA DERECHA (5/12): CARRITO DE LA VENTA               -->
<!-- Vive dentro del x-data de ventas.blade.php, por eso usa   -->
<!-- carrito, cambiarCantidad(), eliminarItem(), opExoneradas, -->
<!-- igv y totalVenta directamente.                            -->
<!-- ========================================================= -->
<div {{ $attributes->merge(['class' => 'lg:col-span-5 xl:col-span-4 flex flex-col h-full']) }}>

    <!-- Encabezado del carrito -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
            <svg class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
            <h3 class="text-sm font-bold uppercase tracking-wide text-slate-800">Venta actual</h3>
            <span x-show="carrito.length > 0"
                class="rounded-full bg-primary/10 border border-primary/25 px-2 py-0.5 text-[11px] font-bold text-primary"
                x-text="carrito.length"></span>
        </div>

        <button type="button" x-show="carrito.length > 0" @click="carrito = []"
            class="inline-flex items-center gap-1 text-xs font-medium text-slate-400 hover:text-red-500 transition cursor-pointer">
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Vaciar
        </button>
    </div>

    <!-- Listado de productos del carrito -->
    <div class="flex-1 overflow-y-auto px-4 py-3">

        <!-- Estado vacío -->
        <div x-show="carrito.length === 0" class="flex h-full flex-col items-center justify-center px-6 text-center">
            <div class="flex h-16 w-16 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-300">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </div>
            <p class="mt-4 text-sm font-semibold text-slate-600">Aún no hay productos</p>
            <p class="mt-1 text-xs text-slate-400">Busca o selecciona un producto para empezar la venta.</p>
        </div>

        <!-- Items -->
        <div class="space-y-2.5">
            <template x-for="(item, index) in carrito" :key="item.id">
                <div class="flex items-center gap-3 rounded-xl border border-slate-200/90 bg-white p-3 shadow-2xs">

                    <!-- Imagen circular o ícono cubo por defecto -->
                    <div class="shrink-0 flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-slate-200 bg-slate-50">
                        <template x-if="item.imagen">
                            <img :src="'/storage/' + item.imagen" :alt="item.nombre"
                                class="h-11 w-11 rounded-full object-cover">
                        </template>
                        <template x-if="!item.imagen">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </template>
                    </div>

                    <!-- Nombre, precio unitario y unidad de medida -->
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-xs font-semibold uppercase tracking-wide text-slate-800"
                            x-text="item.nombre"></p>
                        <p class="mt-0.5 text-[11px] text-slate-500">
                            <span x-text="'S/ ' + item.precio.toFixed(2)"></span>
                            <span class="text-slate-300">·</span>
                            <span class="uppercase" x-text="item.unidad"></span>
                        </p>
                    </div>

                    <!-- Controles de cantidad -->
                    <div class="shrink-0 flex items-center gap-1 rounded-lg border border-slate-200 bg-slate-50 p-0.5">
                        <button type="button" @click="cambiarCantidad(index, -1)"
                            class="flex h-6 w-6 items-center justify-center rounded-md text-slate-600 hover:bg-white hover:text-primary transition cursor-pointer">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </button>
                        <span class="w-7 text-center text-xs font-bold text-slate-800" x-text="item.cantidad"></span>
                        <button type="button" @click="cambiarCantidad(index, 1)" :disabled="item.cantidad >= item.stock"
                            class="flex h-6 w-6 items-center justify-center rounded-md text-slate-600 hover:bg-white hover:text-primary disabled:opacity-30 transition cursor-pointer">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>

                    <!-- Subtotal y quitar -->
                    <div class="shrink-0 w-20 text-right">
                        <p class="text-xs font-bold text-slate-900"
                            x-text="'S/ ' + (item.precio * item.cantidad).toFixed(2)"></p>
                        <button type="button" @click="eliminarItem(index)"
                            class="mt-0.5 text-[11px] font-medium text-slate-400 hover:text-red-500 transition cursor-pointer">
                            Quitar
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Totales y acción de cobro -->
    <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-4">

        <dl class="space-y-1.5 text-sm">
            <div class="flex items-center justify-between text-slate-600">
                <dt>Op. exoneradas</dt>
                <dd class="font-medium" x-text="'S/ ' + opExoneradas.toFixed(2)"></dd>
            </div>
            <div class="flex items-center justify-between text-slate-600">
                <dt>IGV (0%)</dt>
                <dd class="font-medium" x-text="'S/ ' + igv.toFixed(2)"></dd>
            </div>
            <div class="mt-2.5 flex items-center justify-between border-t border-slate-200 pt-2.5">
                <dt class="text-sm font-bold uppercase tracking-wide text-slate-800">Total</dt>
                <dd class="text-xl font-extrabold text-primary" x-text="'S/ ' + totalVenta.toFixed(2)"></dd>
            </div>
        </dl>

        <button type="button" @click="cobrar()" :disabled="carrito.length === 0 || procesando"
            class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-4 py-3 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:shadow-none transition cursor-pointer">
            <!-- Spinner mientras se registra, check cuando está en reposo -->
            <svg x-show="procesando" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg x-show="!procesando" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            <span x-text="procesando ? 'Registrando...' : 'Cobrar venta'"></span>
        </button>
    </div>
</div>
