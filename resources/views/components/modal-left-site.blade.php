@props(['title' => 'Título', 'open' => 'openModal'])

<div x-show="{{ $open }}"
     x-cloak
     @keydown.escape.window="{{ $open }} = false"
     class="fixed inset-0 z-50 overflow-hidden"
     style="display: none;">

    <!-- Fondo oscuro (al hacer clic aquí se cierra) -->
    <div x-show="{{ $open }}"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="{{ $open }} = false"
         class="fixed inset-0 bg-slate-900/50">
    </div>

    <!-- Panel deslizante (en la imagen aparece al lado derecho, si lo quieres a la izquierda cambia 'right-0' por 'left-0' y '-translate-x-full') -->
    <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 pointer-events-none">
        <div x-show="{{ $open }}"
             x-transition:enter="transform transition ease-in-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transform transition ease-in-out duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="w-screen max-w-md pointer-events-auto bg-white shadow-2xl flex flex-col h-full">

            <!-- Cabecera del panel con flecha de volver y título dinámico -->
            <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-200/80 shrink-0">
                <button type="button"
                        @click="{{ $open }} = false"
                        class="p-1.5 -ml-1.5 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </button>
                <h3 class="text-base font-semibold text-slate-800">
                    {{ $title }}
                </h3>
            </div>

            <!-- Contenido dinámico (tu formulario) -->
            <div class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </div>

        </div>
    </div>
</div>