<div x-data="{ role: '{{ old('role', $user->role ?? 'cliente') }}' }" class="space-y-5">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <!-- Nombre -->
        <div class="sm:col-span-2">
            <label for="name" class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-1.5">
                Nombre o Razón Social <span class="text-red-500">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required
                placeholder="Ej. Juan Pérez"
                class="block w-full rounded-lg border border-slate-200 bg-white py-2 px-3 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
            @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Correo electrónico -->
        <div>
            <label for="email" class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-1.5">
                Correo electrónico <span class="text-red-500">*</span>
            </label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                placeholder="usuario@correo.com"
                class="block w-full rounded-lg border border-slate-200 bg-white py-2 px-3 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rol -->
        <div>
            <label for="role" class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-1.5">
                Rol <span class="text-red-500">*</span>
            </label>
            <select id="role" name="role" x-model="role" required
                class="block w-full rounded-lg border border-slate-200 bg-white py-2 px-3 text-sm text-slate-700 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                <option value="cliente">Cliente</option>
                <option value="vendedor">Vendedor</option>
                <option value="almacenero">Almacenero</option>
                <option value="administrador">Administrador</option>
            </select>
            @error('role')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña y Repetir contraseña (solo si rol != cliente) -->
        <div x-show="role !== 'cliente'" x-transition class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="password" class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-1.5">
                    Contraseña
                    @if (!($user->exists ?? false))
                        <span class="text-red-500">*</span>
                    @endif
                </label>
                <input type="password" id="password" name="password"
                    :disabled="role === 'cliente'"
                    :required="role !== 'cliente' && {{ ($user->exists ?? false) ? 'false' : 'true' }}"
                    placeholder="{{ ($user->exists ?? false) ? 'Dejar en blanco para mantener actual' : 'Mínimo 8 caracteres' }}"
                    class="block w-full rounded-lg border border-slate-200 bg-white py-2 px-3 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-1.5">
                    Repetir contraseña
                    @if (!($user->exists ?? false))
                        <span class="text-red-500">*</span>
                    @endif
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    :disabled="role === 'cliente'"
                    :required="role !== 'cliente' && {{ ($user->exists ?? false) ? 'false' : 'true' }}"
                    placeholder="Repite la contraseña"
                    class="block w-full rounded-lg border border-slate-200 bg-white py-2 px-3 text-sm text-slate-700 placeholder-slate-400 shadow-2xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200/80">
        <a href="{{ route('admin.usuarios.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
            Cancelar
        </a>

        <button type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-xs hover:opacity-90 transition cursor-pointer">
            {{ ($user->exists ?? false) ? 'Actualizar' : 'Guardar' }}
        </button>
    </div>
</div>