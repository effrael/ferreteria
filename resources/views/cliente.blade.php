<div>
    <label for="nombre" class="mb-1.5 block text-sm font-semibold text-slate-700">Nombre o Razón Social *</label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}"
           placeholder="Ej. FERRETERÍA DEMO S.A.C." autofocus
           @class([
               'w-full rounded-xl border px-3.5 py-2.5 text-sm',
               'border-red-500' => $errors->has('nombre'),
               'border-slate-200 focus:border-blue-500 focus:outline-none' => ! $errors->has('nombre'),
           ])>
    @error('nombre')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <label for="documento" class="mb-1.5 block text-sm font-semibold text-slate-700">DNI / RUC</label>
        <input type="text" id="documento" name="documento" value="{{ old('documento', $cliente->documento) }}"
               placeholder="Ej. 20000000001"
               @class([
                   'w-full rounded-xl border px-3.5 py-2.5 text-sm',
                   'border-red-500' => $errors->has('documento'),
                   'border-slate-200 focus:border-blue-500 focus:outline-none' => ! $errors->has('documento'),
               ])>
        @error('documento')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="telefono" class="mb-1.5 block text-sm font-semibold text-slate-700">Teléfono</label>
        <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"
               placeholder="Ej. 987654321"
               @class([
                   'w-full rounded-xl border px-3.5 py-2.5 text-sm',
                   'border-red-500' => $errors->has('telefono'),
                   'border-slate-200 focus:border-blue-500 focus:outline-none' => ! $errors->has('telefono'),
               ])>
        @error('telefono')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Correo electrónico</label>
    <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}"
           placeholder="cliente@correo.com"
           @class([
               'w-full rounded-xl border px-3.5 py-2.5 text-sm',
               'border-red-500' => $errors->has('email'),
               'border-slate-200 focus:border-blue-500 focus:outline-none' => ! $errors->has('email'),
           ])>
    @error('email')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="direccion" class="mb-1.5 block text-sm font-semibold text-slate-700">Dirección</label>
    <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}"
           placeholder="Av. Principal 123, Lima"
           @class([
               'w-full rounded-xl border px-3.5 py-2.5 text-sm',
               'border-red-500' => $errors->has('direccion'),
               'border-slate-200 focus:border-blue-500 focus:outline-none' => ! $errors->has('direccion'),
           ])>
    @error('direccion')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="pt-1">
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="estado" value="0">
        <input type="checkbox" name="estado" value="1"
               @checked(old('estado', $cliente->estado))
               class="rounded border-slate-300 text-blue-700 focus:ring-blue-500">
        Cliente activo
    </label>
</div>

<div class="flex items-center gap-3 pt-4">
    <button type="submit"
            class="rounded-xl bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">
        {{ $textoBoton }}
    </button>
    <a href="{{ route('admin.clientes.index') }}"
       class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
        Cancelar
    </a>
</div>