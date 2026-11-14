<!-- resources/views/ventas.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-slate-900 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Vender') }}
            </h2>
        </div>
    </x-slot>

    <div class="h-[calc(100vh-4.5rem)] overflow-hidden bg-slate-50/40"
        x-data="{
            search: '',
            categoriaActiva: 'todos',
            productos: {{ Js::from($productos) }},
            carrito: [],

            get productosFiltrados() {
                return this.productos.filter(p => {
                    const coincideCat = this.categoriaActiva === 'todos' || p.categoria_id == this.categoriaActiva;
                    const q = this.search.toLowerCase().trim();
                    const coincideBusq = q === '' ||
                        (p.nombre && p.nombre.toLowerCase().includes(q)) ||
                        (p.codigo && p.codigo.toLowerCase().includes(q));
                    return coincideCat && coincideBusq;
                });
            },

            agregarAlCarrito(prod) {
                if (prod.stock <= 0) {
                    alert('Producto sin stock disponible.');
                    return;
                }
                const existente = this.carrito.find(item => item.id === prod.id);
                if (existente) {
                    if (existente.cantidad < prod.stock) {
                        existente.cantidad++;
                    } else {
                        alert('No hay más stock disponible para este producto.');
                    }
                } else {
                    this.carrito.push({
                        id: prod.id,
                        nombre: prod.nombre,
                        precio: parseFloat(prod.precioventa),
                        stock: prod.stock,
                        unidad: prod.unidadmedida ? prod.unidadmedida.nombre : 'UND',
                        imagen: prod.imagen,
                        cantidad: 1
                    });
                }
            },

            cambiarCantidad(index, delta) {
                const item = this.carrito[index];
                const nueva = item.cantidad + delta;
                if (nueva <= 0) {
                    this.carrito.splice(index, 1);
                } else if (nueva <= item.stock) {
                    item.cantidad = nueva;
                } else {
                    alert('Stock máximo alcanzado.');
                }
            },

            eliminarItem(index) {
                this.carrito.splice(index, 1);
            },

            get totalVenta() {
                return this.carrito.reduce((acc, item) => acc + (item.precio * item.cantidad), 0);
            },

            get opExoneradas() {
                return this.totalVenta;
            },

            get igv() {
                return 0;
            },

            procesando: false,

            async cobrar() {
                if (this.carrito.length === 0 || this.procesando) return;

                this.procesando = true;

                try {
                    const respuesta = await fetch('{{ route('admin.ventas.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=&quot;csrf-token&quot;]').content,
                        },
                        body: JSON.stringify({
                            items: this.carrito.map(item => ({
                                producto_id: item.id,
                                cantidad: item.cantidad
                            }))
                        }),
                    });

                    const datos = await respuesta.json();

                    if (!respuesta.ok) {
                        // 422: el servidor rechazó la venta (sin stock, producto inactivo...)
                        alert(datos.message ?? 'No se pudo registrar la venta.');
                        return;
                    }

                    // Descontamos el stock en la lista local para no recargar la página.
                    this.carrito.forEach(item => {
                        const prod = this.productos.find(p => p.id === item.id);
                        if (prod) prod.stock -= item.cantidad;
                    });

                    this.carrito = [];
                    alert(datos.mensaje);
                } catch (error) {
                    alert('Error de conexión. La venta no se registró.');
                } finally {
                    this.procesando = false;
                }
            }
        }">

        <div class="grid grid-cols-1 lg:grid-cols-12 h-full">

            <!-- ========================================================= -->
            <!-- COLUMNA IZQUIERDA (7/12): BUSCADOR, CATEGORÍAS Y TARJETAS -->
            <!-- ========================================================= -->
            <div class="lg:col-span-7 xl:col-span-8 flex flex-col h-full border-r border-slate-200/80 overflow-hidden">

                <!-- Barra superior: Buscador + Botón Agregar producto -->
                <div class="p-4 pb-3 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <div class="relative flex-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input type="text" x-model="search"
                            @keydown.enter.prevent="if (productosFiltrados.length === 1) { agregarAlCarrito(productosFiltrados[0]); search = ''; }"
                            placeholder="buscar producto por código de barras o nombre"
                            class="block w-full rounded-lg border border-slate-200 bg-white py-2 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                    </div>

                    <a href="{{ route('admin.inventario.index') }}"
                        class="shrink-0 inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Agregar producto</span>
                    </a>
                </div>

                <!-- Píldoras horizontales de Categorías -->
                <div class="px-4 pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2 overflow-x-auto pb-1.5 scrollbar-thin">
                        <button type="button" @click="categoriaActiva = 'todos'"
                            :class="categoriaActiva === 'todos'
                                ? 'bg-primary/10 border-primary/30 text-primary font-semibold'
                                : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'"
                            class="shrink-0 rounded-full border px-4 py-1.5 text-xs transition cursor-pointer">
                            Todos
                        </button>

                        @foreach ($categorias as $categoria)
                            <button type="button" @click="categoriaActiva = {{ $categoria->id }}"
                                :class="categoriaActiva == {{ $categoria->id }}
                                    ? 'bg-primary/10 border-primary/30 text-primary font-semibold'
                                    : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'"
                                class="shrink-0 rounded-full border px-4 py-1.5 text-xs transition cursor-pointer">
                                {{ $categoria->nombre }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Grid de Tarjetas de Productos -->
                <div class="flex-1 overflow-y-auto p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3.5">
                        <template x-for="prod in productosFiltrados" :key="prod.id">
                            <div class="relative flex flex-col items-center justify-between rounded-xl border border-slate-200/90 bg-white p-4 text-center shadow-2xs hover:border-primary/40 transition">

                                <!-- Badge Unidad de Medida (arriba izquierda) -->
                                <span class="self-start rounded-md border border-slate-200 bg-slate-50 px-2 py-0.5 text-[10px] font-semibold uppercase text-slate-600"
                                    x-text="prod.unidadmedida ? prod.unidadmedida.nombre : 'UND'">
                                </span>

                                <!-- Imagen circular o ícono cubo por defecto -->
                                <div class="my-2 flex h-14 w-14 items-center justify-center rounded-full overflow-hidden">
                                    <template x-if="prod.imagen">
                                        <img :src="'/storage/' + prod.imagen" :alt="prod.nombre"
                                            class="h-14 w-14 object-cover rounded-full">
                                    </template>
                                    <template x-if="!prod.imagen">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-500">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                            </svg>
                                        </div>
                                    </template>
                                </div>

                                <!-- Nombre del producto -->
                                <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-800 line-clamp-1 mb-2"
                                    x-text="prod.nombre">
                                </h3>

                                <!-- Píldoras de Precio y Stock -->
                                <div class="flex items-center justify-center gap-1.5 mb-3">
                                    <span class="rounded-full bg-primary/10 border border-primary/25 px-2.5 py-0.5 text-xs font-bold text-primary"
                                        x-text="'S/ ' + parseFloat(prod.precioventa).toFixed(2)">
                                    </span>
                                    <span class="rounded-full border border-slate-200 bg-white px-2.5 py-0.5 text-xs font-medium text-slate-600"
                                        x-text="prod.stock > 9999 ? '+9999' : prod.stock">
                                    </span>
                                </div>

                                <!-- Botón + Agregar -->
                                <button type="button" @click="agregarAlCarrito(prod)"
                                    :disabled="prod.stock <= 0"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-xs font-semibold text-slate-700 hover:bg-primary hover:text-white hover:border-primary disabled:opacity-40 transition cursor-pointer">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span x-text="prod.stock > 0 ? 'Agregar' : 'Sin stock'"></span>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Mensaje cuando no hay coincidencias -->
                    <div x-show="productosFiltrados.length === 0" class="py-16 text-center text-sm text-slate-400">
                        No se encontraron productos que coincidan con la búsqueda.
                    </div>
                </div>
            </div>

            <x-cart/>
        </div>
    </div>
</x-app-layout>