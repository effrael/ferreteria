<!-- resources/views/inventario.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{
        search: '',
        openModal: false,
        editModal: false,
        productoEdit: {},
        categorias: {{ Js::from($categorias) }},
        marcas: {{ Js::from($marcas) }},
        unidades: {{ Js::from($unidades) }},
        async crearRapido(url, nombre, lista, callback) {
            if (!nombre.trim()) return;
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nombre: nombre.trim() })
            });
            if (res.ok) {
                const nuevo = await res.json();
                this[lista].push(nuevo);
                callback(nuevo.id);
            } else {
                const err = await res.json();
                alert(err.message || 'No se pudo crear (verifica si ya existe).');
            }
        }
    }">
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

            <!-- Barra superior: Buscador + Botón Crear Producto -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <div class="relative flex-1 max-w-5xl">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" x-model="search" placeholder="Buscar producto por nombre, código o marca..."
                        class="block w-full rounded-lg border border-slate-200 bg-white py-2 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div class="shrink-0">
                    <button type="button" @click="openModal = true"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Crear Producto</span>
                    </button>
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
                                    Código
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Imagen
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Marca
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Categoría
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Medida
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    P. Venta
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    P. Compra
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Stock
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500 whitespace-nowrap">
                                    Descripción
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
                            @forelse ($productos as $producto)
                                <tr x-show="search === '' || '{{ strtolower($producto->nombre . ' ' . $producto->codigo . ' ' . ($producto->marca->nombre ?? '')) }}'.includes(search.toLowerCase())"
                                    class="odd:bg-slate-50/70 even:bg-white hover:bg-slate-100/70 transition-colors">
                                    <td class="whitespace-nowrap py-3.5 pl-6 pr-3 text-[13px] text-slate-700">
                                        {{ $producto->codigo ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        @if ($producto->imagen)
                                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                                class="h-9 w-9 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <span class="text-xs text-slate-400">Sin img</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] font-medium text-slate-800">
                                        {{ $producto->nombre }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        {{ $producto->marca->nombre ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        {{ $producto->categoria->nombre ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-600">
                                        {{ $producto->unidadmedida->nombre ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] font-medium text-slate-800">
                                        S/ {{ number_format($producto->precioventa ?? 0, 2) }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700">
                                        S/ {{ number_format($producto->preciocompra ?? 0, 2) }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700">
                                        {{ $producto->stock }}
                                    </td>
                                    <td class="px-3 py-3.5 text-[13px] text-slate-600 max-w-xs truncate">
                                        {{ $producto->descripcion ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px]">
                                        @if ($producto->estado)
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
                                    <td class="whitespace-nowrap py-3.5 pl-3 pr-6 text-right text-sm font-medium space-x-1 flex">
                                        <!-- Botón Editar -->
                                        <button type="button"
                                            @click="productoEdit = {{ Js::from($producto) }}; editModal = true"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-[var(--color-primary)] hover:bg-slate-200/70 transition cursor-pointer">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <span>Editar</span>
                                        </button>

                                        <!-- Botón Desactivar -->
                                       <!-- Botón Activar / Desactivar -->
                                        @if ($producto->estado)
                                            <form action="{{ route('admin.inventario.destroy', $producto) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('¿Desactivar el producto {{ $producto->nombre }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-red-600 hover:bg-red-50 transition cursor-pointer">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.inventario.destroy', $producto) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('¿Activar el producto {{ $producto->nombre }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium text-emerald-600 hover:bg-emerald-50 transition cursor-pointer">
                                                    Activar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="py-10 px-6 text-center text-sm text-slate-400">
                                        No hay productos registrados todavía. Haz clic en
                                        <button type="button" @click="openModal = true"
                                            class="text-slate-600 inline-flex items-center justify-center text-sm font-semibold shadow-xs hover:opacity-90 transition cursor-pointer">
                                            <span>Crear Producto</span>
                                        </button> para agregar el primero.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($productos->hasPages())
                    <div class="border-t border-slate-200/80 px-6 py-3">
                        {{ $productos->links() }}
                    </div>
                @endif
            </div>

        </div>

        <!-- ========================================================= -->
        <!-- MODAL DESLIZANTE: CREAR PRODUCTO                          -->
        <!-- ========================================================= -->
        <x-modal-left-site title="Crear producto" open="openModal">
            <form action="{{ route('admin.inventario.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Código
                    </label>
                    <input type="text" name="codigo" value="{{ old('codigo') }}"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <!-- Marca con creación rápida -->
                <div x-data="{ nuevaMarca: false, nombreMarca: '', selectedMarca: '{{ old('marca_id') }}' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Marca</label>
                    <div class="flex items-center gap-2">
                        <select name="marca_id" x-model="selectedMarca"
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar marca</option>
                            <template x-for="m in marcas" :key="m.id">
                                <option :value="m.id" x-text="m.nombre" :selected="m.id == selectedMarca"></option>
                            </template>
                        </select>
                        <button type="button" @click="nuevaMarca = !nuevaMarca"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span x-text="nuevaMarca ? 'Cerrar' : '+ Crear'"></span>
                        </button>
                    </div>
                    <div x-show="nuevaMarca" x-transition class="mt-2 flex items-center gap-2">
                        <input type="text" x-model="nombreMarca" placeholder="Nueva marca..."
                            @keydown.enter.prevent="crearRapido('{{ route('admin.marcas.store') }}', nombreMarca, 'marcas', (id) => { selectedMarca = id; nombreMarca = ''; nuevaMarca = false; })"
                            class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:outline-none">
                        <button type="button"
                            @click="crearRapido('{{ route('admin.marcas.store') }}', nombreMarca, 'marcas', (id) => { selectedMarca = id; nombreMarca = ''; nuevaMarca = false; })"
                            class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700 cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </div>

                <!-- Categoría con creación rápida -->
                <div x-data="{ nuevaCat: false, nombreCat: '', selectedCat: '{{ old('categoria_id') }}' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Categoría <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <select name="categoria_id" x-model="selectedCat" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar categoría</option>
                            <template x-for="c in categorias" :key="c.id">
                                <option :value="c.id" x-text="c.nombre" :selected="c.id == selectedCat"></option>
                            </template>
                        </select>
                        <button type="button" @click="nuevaCat = !nuevaCat"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span x-text="nuevaCat ? 'Cerrar' : '+ Crear'"></span>
                        </button>
                    </div>
                    <div x-show="nuevaCat" x-transition class="mt-2 flex items-center gap-2">
                        <input type="text" x-model="nombreCat" placeholder="Nueva categoría..."
                            @keydown.enter.prevent="crearRapido('{{ route('admin.categorias.store') }}', nombreCat, 'categorias', (id) => { selectedCat = id; nombreCat = ''; nuevaCat = false; })"
                            class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:outline-none">
                        <button type="button"
                            @click="crearRapido('{{ route('admin.categorias.store') }}', nombreCat, 'categorias', (id) => { selectedCat = id; nombreCat = ''; nuevaCat = false; })"
                            class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700 cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </div>

                <!-- Unidad de medida con creación rápida -->
                <div x-data="{ nuevaUnidad: false, nombreUnidad: '', selectedUnidad: '{{ old('unidad_id') }}' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Unidad de medida</label>
                    <div class="flex items-center gap-2">
                        <select name="unidad_id" x-model="selectedUnidad"
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar unidad</option>
                            <template x-for="u in unidades" :key="u.id">
                                <option :value="u.id" x-text="u.nombre" :selected="u.id == selectedUnidad"></option>
                            </template>
                        </select>
                        <button type="button" @click="nuevaUnidad = !nuevaUnidad"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span x-text="nuevaUnidad ? 'Cerrar' : '+ Crear'"></span>
                        </button>
                    </div>
                    <div x-show="nuevaUnidad" x-transition class="mt-2 flex items-center gap-2">
                        <input type="text" x-model="nombreUnidad" placeholder="Ej: Caja, Metro, Unidad..."
                            @keydown.enter.prevent="crearRapido('{{ route('admin.unidades.store') }}', nombreUnidad, 'unidades', (id) => { selectedUnidad = id; nombreUnidad = ''; nuevaUnidad = false; })"
                            class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:outline-none">
                        <button type="button"
                            @click="crearRapido('{{ route('admin.unidades.store') }}', nombreUnidad, 'unidades', (id) => { selectedUnidad = id; nombreUnidad = ''; nuevaUnidad = false; })"
                            class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700 cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio de venta <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" min="0.1" name="precioventa" value="{{ old('precioventa', 0) }}"
                        required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio de compra
                    </label>
                    <input type="number" step="0.01" min="0" name="preciocompra" value="{{ old('preciocompra', 0) }}"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Stock inicial <span class="text-red-500">*</span>
                    </label>
                    <input type="number" min="0" name="stock" value="{{ old('stock', 0) }}" required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Imagen
                    </label>
                    <input type="file" name="imagen" accept="image/png,image/jpeg,image/webp"
                        class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-slate-700 hover:file:bg-slate-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Descripción
                    </label>
                    <textarea name="descripcion" rows="2"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">{{ old('descripcion') }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="rounded-lg bg-primary px-5 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                        Guardar
                    </button>
                </div>
            </form>
        </x-modal-left-site>

        <!-- ========================================================= -->
        <!-- MODAL DESLIZANTE: EDITAR PRODUCTO                         -->
        <!-- ========================================================= -->
        <x-modal-left-site title="Editar producto" open="editModal">
            <form :action="'/admin/inventario/' + productoEdit.id" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" x-model="productoEdit.nombre" required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Código
                    </label>
                    <input type="text" name="codigo" x-model="productoEdit.codigo"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <!-- Marca con creación rápida -->
                <div x-data="{ nuevaMarcaEdit: false, nombreMarcaEdit: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Marca</label>
                    <div class="flex items-center gap-2">
                        <select name="marca_id" x-model="productoEdit.marca_id"
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar marca</option>
                            <template x-for="m in marcas" :key="m.id">
                                <option :value="m.id" x-text="m.nombre" :selected="m.id == productoEdit.marca_id">
                                </option>
                            </template>
                        </select>
                        <button type="button" @click="nuevaMarcaEdit = !nuevaMarcaEdit"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span x-text="nuevaMarcaEdit ? 'Cerrar' : '+ Crear'"></span>
                        </button>
                    </div>
                    <div x-show="nuevaMarcaEdit" x-transition class="mt-2 flex items-center gap-2">
                        <input type="text" x-model="nombreMarcaEdit" placeholder="Nueva marca..."
                            @keydown.enter.prevent="crearRapido('{{ route('admin.marcas.store') }}', nombreMarcaEdit, 'marcas', (id) => { productoEdit.marca_id = id; nombreMarcaEdit = ''; nuevaMarcaEdit = false; })"
                            class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:outline-none">
                        <button type="button"
                            @click="crearRapido('{{ route('admin.marcas.store') }}', nombreMarcaEdit, 'marcas', (id) => { productoEdit.marca_id = id; nombreMarcaEdit = ''; nuevaMarcaEdit = false; })"
                            class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700 cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </div>

                <!-- Categoría con creación rápida -->
                <div x-data="{ nuevaCatEdit: false, nombreCatEdit: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Categoría <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <select name="categoria_id" x-model="productoEdit.categoria_id" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar categoría</option>
                            <template x-for="c in categorias" :key="c.id">
                                <option :value="c.id" x-text="c.nombre" :selected="c.id == productoEdit.categoria_id">
                                </option>
                            </template>
                        </select>
                        <button type="button" @click="nuevaCatEdit = !nuevaCatEdit"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span x-text="nuevaCatEdit ? 'Cerrar' : '+ Crear'"></span>
                        </button>
                    </div>
                    <div x-show="nuevaCatEdit" x-transition class="mt-2 flex items-center gap-2">
                        <input type="text" x-model="nombreCatEdit" placeholder="Nueva categoría..."
                            @keydown.enter.prevent="crearRapido('{{ route('admin.categorias.store') }}', nombreCatEdit, 'categorias', (id) => { productoEdit.categoria_id = id; nombreCatEdit = ''; nuevaCatEdit = false; })"
                            class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:outline-none">
                        <button type="button"
                            @click="crearRapido('{{ route('admin.categorias.store') }}', nombreCatEdit, 'categorias', (id) => { productoEdit.categoria_id = id; nombreCatEdit = ''; nuevaCatEdit = false; })"
                            class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700 cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </div>

                <!-- Unidad de medida con creación rápida -->
                <div x-data="{ nuevaUnidadEdit: false, nombreUnidadEdit: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Unidad de medida</label>
                    <div class="flex items-center gap-2">
                        <select name="unidad_id" x-model="productoEdit.unidad_id"
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar unidad</option>
                            <template x-for="u in unidades" :key="u.id">
                                <option :value="u.id" x-text="u.nombre" :selected="u.id == productoEdit.unidad_id">
                                </option>
                            </template>
                        </select>
                        <button type="button" @click="nuevaUnidadEdit = !nuevaUnidadEdit"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span x-text="nuevaUnidadEdit ? 'Cerrar' : '+ Crear'"></span>
                        </button>
                    </div>
                    <div x-show="nuevaUnidadEdit" x-transition class="mt-2 flex items-center gap-2">
                        <input type="text" x-model="nombreUnidadEdit" placeholder="Ej: Caja, Metro, Unidad..."
                            @keydown.enter.prevent="crearRapido('{{ route('admin.unidades.store') }}', nombreUnidadEdit, 'unidades', (id) => { productoEdit.unidad_id = id; nombreUnidadEdit = ''; nuevaUnidadEdit = false; })"
                            class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:outline-none">
                        <button type="button"
                            @click="crearRapido('{{ route('admin.unidades.store') }}', nombreUnidadEdit, 'unidades', (id) => { productoEdit.unidad_id = id; nombreUnidadEdit = ''; nuevaUnidadEdit = false; })"
                            class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700 cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio de venta <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" min="0.1" name="precioventa" x-model="productoEdit.precioventa"
                        required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio de compra
                    </label>
                    <input type="number" step="0.01" min="0" name="preciocompra" x-model="productoEdit.preciocompra"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Stock <span class="text-red-500">*</span>
                    </label>
                    <input type="number" min="0" name="stock" x-model="productoEdit.stock" required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Cambiar imagen (opcional)
                    </label>
                    <input type="file" name="imagen" accept="image/png,image/jpeg,image/webp"
                        class="w-full rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-700 file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-slate-700 hover:file:bg-slate-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Descripción
                    </label>
                    <textarea name="descripcion" rows="2" x-model="productoEdit.descripcion"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none"></textarea>
                </div>
                @if (auth()->user()->role === 'administrador')
                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="estado" value="0">
                            <input type="checkbox" name="estado" value="1" x-model="productoEdit.estado"
                                class="rounded border-slate-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                            <span class="text-sm font-medium text-slate-700">Producto activo</span>
                        </label>
                    </div>
                @endif
                <div class="pt-2">
                    <button type="submit"
                        class="rounded-lg bg-primary px-5 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                        Actualizar
                    </button>
                </div>
            </form>
        </x-modal-left-site>

    </div>
</x-app-layout>