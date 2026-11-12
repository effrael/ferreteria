<x-guest-layout>
    <!-- Encabezado del Login -->
    <div class="mb-8">
        <!-- Logo visible solo en móviles (cuando se oculta el panel izquierdo) -->
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-white shadow-md shadow-primary/30">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.29 7 12 12 20.71 7"/>
                    <line x1="12" y1="22" x2="12" y2="12"/>
                </svg>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-primary">
                EJJ<span class="text-primary/40">.</span>
            </span>
        </div>

        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-950">
            Bienvenido de nuevo
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            Ingresa tus credenciales para acceder a tu ferretería.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-slate-700 font-semibold" />
            <x-text-input id="email" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary" 
                type="email" 
                name="email" 
                :value="old('email')"
                placeholder="nombre@ferreteria.com"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Contraseña')" class="text-slate-700 font-semibold" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-primary hover:text-primary/80 transition-colors"
                        href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm focus:border-primary focus:ring-primary" 
                type="password" 
                name="password" 
                placeholder="••••••••"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-slate-300 text-primary shadow-sm focus:ring-primary" 
                    name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Mantener sesión iniciada') }}</span>
            </label>
        </div>

        <!-- Botón Submit -->
        <div class="pt-2">
            <button type="submit" 
                class="w-full flex justify-center items-center py-3 px-4 rounded-xl bg-primary text-white text-sm font-semibold shadow-lg shadow-primary/25 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all cursor-pointer">
                {{ __('Iniciar sesión') }}
            </button>
        </div>
    </form>
</x-guest-layout>