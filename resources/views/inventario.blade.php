<!-- resources/views/inventario.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>


    <div class="py-6" x-data="{ search: '', openModal: false }">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            <!-- Barra superior: Buscador + Botón Crear Producto -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <!-- Input de búsqueda -->
                <div class="relative flex-1 max-w-5xl">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" x-model="search" placeholder="buscar producto por nombre"
                        class="block w-full rounded-lg border border-slate-200 bg-white py-2 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <!-- Botón Crear Producto -->
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
                                    class="py-3.5 pl-6 pr-3 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Código
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-6 pr-3 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Imagen
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Marca
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Categoía
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Medida
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    P. Venta
                                </th>
                    
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    P. Compra
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Stock
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
                                    Descripción
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-[11px] font-semibold tracking-wider text-slate-500  whitespace-nowrap">
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
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700">
                                        {{ $producto->precioventa }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700">
                                        {{ $producto->preciocompra }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-3.5 text-[13px] text-slate-700">
                                        {{ $producto->stock }}
                                    </td>
                                    <td class="whitespace-nowrap py-3.5 pl-3 pr-6 text-right text-sm font-medium">
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-[var(--color-primary)] hover:bg-slate-200/70 transition cursor-pointer">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <span>Editar</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="py-10 px-6 text-center text-sm text-slate-400">
                                        No hay productos registrados todavía. Haz clic en
                                        <button type="button" @click="openModal = true"
                                            class="text-slate-600 inline-flex items-center justify-center  text-sm font-semibold  shadow-xs hover:opacity-90 transition cursor-pointer">

                                            <span>Crear Producto</span>
                                        </button> para agregar el
                                        primero.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Modal deslizante para Crear Producto -->
        <x-modal-left-site title="Crear producto" open="openModal">
            <form action="#" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Marca
                    </label>
                    <input type="text" name="marca"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Categoría <span class="text-red-500">*</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <select name="categoria_id" required
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                            <option value="">Seleccionar categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>

                        <button type="button"
                            class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition cursor-pointer">
                            <span>+ Crear</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Código de barras
                    </label>
                    <input type="text" name="codigo"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio de compra
                    </label>
                    <input type="number" step="0.01" name="precio_compra" value="0"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio por mayor
                    </label>
                    <input type="number" step="0.01" name="precio_mayor" value="0"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Precio de venta
                    </label>
                    <input type="number" step="0.01" name="precio_venta" value="0"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Stock inicial
                    </label>
                    <input type="number" name="stock" value="0"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Unidad de medida
                    </label>
                    <select name="medida"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                        <option value="UND">UNIDAD</option>
                        <option value="BOLSA">BOLSA</option>
                        <option value="TUBO">TUBO</option>
                        <option value="ROLLO">ROLLO</option>
                        <option value="GAL">GALÓN</option>
                        <option value="KG">KILOGRAMO</option>
                        <option value="MTR">METRO</option>
                        <option value="CAJA">CAJA</option>
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="rounded-lg bg-primary px-5 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                        Guardar
                    </button>
                </div>
            </form>
        </x-modal-left-site>

    </div>
</x-app-layout>