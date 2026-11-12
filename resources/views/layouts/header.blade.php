<header class="sticky top-0 z-10 h-16 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between">
    
    <!-- Izquierda: Botón móvil + Título de la página -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" 
                type="button" 
                class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        @isset($header)
            <div class="text-sm font-semibold text-slate-800">
                {{ $header }}
            </div>
        @endisset
    </div>

    <!-- Derecha: Notificaciones + Perfil de Usuario -->
    <div class="flex items-center gap-5">
        
        <!-- Campana de notificaciones -->
        <button type="button" class="relative p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
        </button>

        <!-- Dropdown de Usuario (Mantiene la lógica de Breeze) -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-3 text-right focus:outline-none group">
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-slate-800 group-hover:text-[var(--color-primary)] transition">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-xs text-slate-400">
                            {{ Auth::user()->role ?? 'Vendedor' }}
                        </div>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    </div>
</header>