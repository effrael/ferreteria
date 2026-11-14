<div>
    <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">
        Nombre <span class="text-red-500">*</span>
    </label>
    <input type="text" id="nombre" name="nombre"
           value="{{ old('nombre', $metodosPago->nombre) }}" autofocus
           @class([
               'w-full rounded-lg border px-3 py-2 text-sm text-slate-700 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none',
               'border-red-500' => $errors->has('nombre'),
               'border-slate-200' => ! $errors->has('nombre'),
           ])>
    @error('nombre')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="inline-flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
        <input type="hidden" name="estado" value="0">
        <input type="checkbox" name="estado" value="1"
               @checked(old('estado', $metodosPago->estado))
               class="rounded border-slate-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
        Método de pago activo
    </label>
</div>

<div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
    <a href="{{ route('admin.metodos-pago.index') }}"
       class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
        Cancelar
    </a>
    <button type="submit"
            class="rounded-lg bg-[var(--color-primary)] px-5 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
        {{ $textoBoton }}
    </button>
</div>