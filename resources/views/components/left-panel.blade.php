<div class="relative flex flex-col justify-between min-h-screen bg-surface p-8 sm:p-12 lg:p-16 font-sans select-none">
    
    <!-- Logo Superior -->
    <div class="flex items-center gap-3.5">
        <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-primary text-white shadow-lg shadow-primary/30">
            <!-- Icono Cubo 3D -->
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.29 7 12 12 20.71 7"/>
                <line x1="12" y1="22" x2="12" y2="12"/>
            </svg>
        </div>
        <span class="text-2xl font-extrabold tracking-tight text-primary">
            EJJ<span class="text-primary/40">.</span>
        </span>
    </div>

    <!-- Título Principal y Descripción -->
    <div class="my-12 max-w-lg">
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-950 leading-[1.12]">
            Todo en orden.<br>
            Tu negocio,<br>
            <span class="text-primary">un paso adelante.</span>
        </h1>

        <p class="mt-6 text-base sm:text-[17px] text-slate-600 leading-relaxed max-w-md">
            Gestiona tus ventas y tu inventario desde un solo lugar. Más control para ti, más posibilidades para tu ferretería.
        </p>
    </div>

    <!-- Tarjeta Inferior Interactiva / Preview -->
    <div class="relative max-w-xl pb-5">
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-[0_20px_50px_rgba(8,32,215,0.06)] border border-slate-100">
            
            <!-- Header de la tarjeta -->
            <div class="flex items-center justify-between pb-5 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                    <span class="text-sm font-bold text-slate-800">Tu negocio, conectado</span>
                </div>
                <!-- Puntos decorativos -->
                <div class="flex items-center gap-1 text-slate-300">
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                </div>
            </div>

            <!-- Grid de 3 módulos -->
            <div class="grid grid-cols-3 gap-3 sm:gap-4 mt-6">
                
                <!-- Ventas -->
                <div class="flex flex-col items-center justify-center py-6 px-3 rounded-2xl bg-surface/80 hover:bg-surface transition-colors">
                    <svg class="w-6 h-6 text-primary mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span class="text-xs sm:text-sm font-medium text-slate-600">Ventas</span>
                </div>

                <!-- Inventario -->
                <div class="flex flex-col items-center justify-center py-6 px-3 rounded-2xl bg-surface/80 hover:bg-surface transition-colors">
                    <svg class="w-6 h-6 text-primary mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.29 7 12 12 20.71 7"/>
                        <line x1="12" y1="22" x2="12" y2="12"/>
                    </svg>
                    <span class="text-xs sm:text-sm font-medium text-slate-600">Inventario</span>
                </div>

                <!-- Reportes -->
                <div class="flex flex-col items-center justify-center py-6 px-3 rounded-2xl bg-surface/80 hover:bg-surface transition-colors">
                    <svg class="w-6 h-6 text-primary mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                        <line x1="3" y1="20" x2="21" y2="20"/>
                    </svg>
                    <span class="text-xs sm:text-sm font-medium text-slate-600">Reportes</span>
                </div>

            </div>
        </div>

        <!-- Badge Flotante Inferior Derecho -->
        <div class="absolute -bottom-1 -right-2 sm:-right-4 flex items-center gap-3 bg-white py-2.5 px-4 rounded-full shadow-[0_10px_25px_rgba(0,0,0,0.08)] border border-slate-100">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-primary text-white">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </span>
            <span class="text-xs sm:text-sm font-semibold text-slate-700 pr-1">Todo bajo control</span>
        </div>
    </div>

</div>