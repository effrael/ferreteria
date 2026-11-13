<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Registrar nuevo producto') }}
            </h2>
            <a href="{{ route('admin.inventario.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                ← Volver al inventario
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                        <p class="font-semibold mb-1">Corrige los siguientes errores:</p>
                        <ul class="list-disc pl-5 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.inventario.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Código de barras</label>
                            <input type="text" name="codigo" value="{{ old('codigo') }}"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Categoría <span class="text-red-500">*</span>
                            </label>
                            <select name="categoria_id" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                                <option value="">Seleccionar...</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Marca</label>
                            <select name="marca_id"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                                <option value="">Seleccionar...</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}" @selected(old('marca_id') == $marca->id)>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Unidad de medida</label>
                            <select name="unidad_medida_id"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                                <option value="">Seleccionar...</option>
                                @foreach ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}" @selected(old('unidad_medida_id') == $unidad->id)>
                                        {{ $unidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Precio de compra (S/)</label>
                            <input type="number" step="0.01" min="0" name="preciocompra" value="{{ old('preciocompra', 0) }}"
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Precio de venta (S/) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" min="0.1" name="precioventa" value="{{ old('precioventa') }}" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Stock inicial <span class="text-red-500">*</span>
                            </label>
                            <input type="number" min="0" name="stock" value="{{ old('stock', 0) }}" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3"
                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.inventario.index') }}"
                            class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="rounded-lg bg-[var(--color-primary)] px-5 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
                            Guardar producto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>