<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-slate-200/80 transition-transform duration-200 ease-in-out lg:translate-x-0 flex flex-col">
    
    <!-- Logo (Alineado con la altura del Header h-16) -->
    <div class="h-16 flex items-center px-6 border-b border-slate-200/80 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <!-- Ícono cuadrado con tu color primario -->
            <div class="w-9 h-9 rounded-xl bg-[var(--color-primary)] flex items-center justify-center text-white shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-[var(--color-primary)]">EJJ.</span>
        </a>
    </div>

    <!-- Navegación -->
    <div class="flex-1 overflow-y-auto px-3 py-6 space-y-1">
        <div class="px-3 mb-3 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">
            Espacio de trabajo
        </div>

        @php
            $navItems = [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'active' => request()->routeIs('dashboard'),
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />',
                ],
                [
                    'label' => 'Ventas',
                    'route' => '#', // Cambia por route('ventas.index')
                    'active' => request()->routeIs('ventas.*'),
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />',
                ],
                [
                    'label' => 'Cotizaciones',
                    'route' => '#', // Cambia por route('cotizaciones.index')
                    'active' => request()->routeIs('cotizaciones.*'), // Pon true temporalmente para verlo activo
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
                ],
                [
                    'label' => 'Órdenes de venta',
                    'route' => '#',
                    'active' => request()->routeIs('ordenes.*'),
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />',
                ],
                [
                    'label' => 'Inventario',
                    'route' => '#',
                    'active' => request()->routeIs('inventario.*'),
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />',
                ],
                [
                    'label' => 'Clientes',
                    'route' => '#',
                    'active' => request()->routeIs('clientes.*'),
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />',
                ],
            ];
        @endphp

        @foreach ($navItems as $item)
            <a href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
                      {{ $item['active'] 
                          ? 'bg-[var(--color-primary)] text-white shadow-sm' 
                          : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg class="w-5 h-5 shrink-0 {{ $item['active'] ? 'text-white' : 'text-slate-400' }}" 
                     fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    {!! $item['icon'] !!}
                </svg>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </div>
</aside>