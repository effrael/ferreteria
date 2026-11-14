@php
    $categorias = [
        'todas' => 'Todas',
        'empezar' => 'Para empezar',
        'uso' => 'Uso diario',
        'usuarios' => 'Usuarios y permisos',
        'datos' => 'Datos y seguridad',
        'pagos' => 'Pagos y facturación',
    ];

    $faqs = [
        // ---------- Para empezar ----------
        [
            'categoria' => 'empezar',
            'pregunta' => '¿Necesito instalar algo en mi computadora?',
            'respuesta' => 'No. EJJ. funciona dentro del navegador que ya usas, igual que tu correo. No hay programa que instalar, ni licencias por computadora, ni actualizaciones que descargar. Entras con tu usuario y contraseña desde cualquier equipo de la tienda.',
        ],
        [
            'categoria' => 'empezar',
            'pregunta' => '¿Cuánto tarda en estar listo para vender?',
            'respuesta' => 'Crear la cuenta toma menos de cinco minutos. Lo que realmente toma tiempo es cargar tu inventario: una ferretería con unos 200 productos suele terminar en una tarde. Puedes empezar con los productos que más vendes y seguir cargando el resto sobre la marcha.',
        ],
        [
            'categoria' => 'empezar',
            'pregunta' => '¿Me ayudan a configurarlo?',
            'respuesta' => 'Sí. En todos los planes te acompañamos por correo o WhatsApp mientras configuras tus categorías y cargas tus primeros productos. En el plan Ferretería incluimos además una capacitación inicial para tu equipo.',
        ],
        [
            'categoria' => 'empezar',
            'pregunta' => '¿Puedo pasar mi inventario desde un Excel?',
            'respuesta' => 'Todavía no de forma automática. Hoy los productos se registran desde el panel, uno por uno. La importación masiva desde Excel es uno de los módulos que estamos construyendo. Si tienes cientos de productos y necesitas cargarlos ya, escríbenos: lo vemos caso por caso.',
        ],

        // ---------- Uso diario ----------
        [
            'categoria' => 'uso',
            'pregunta' => '¿Funciona sin internet?',
            'respuesta' => 'No. EJJ. necesita conexión porque tu información vive en la nube, y eso es justamente lo que te permite entrar desde la caja, desde la oficina o desde tu casa con los mismos datos. Si tu conexión es inestable, tenlo en cuenta antes de contratar: preferimos decírtelo ahora.',
        ],
        [
            'categoria' => 'uso',
            'pregunta' => '¿Puedo usarlo en dos cajas al mismo tiempo?',
            'respuesta' => 'Sí, y está pensado para eso. Cuando una caja cierra una venta, el sistema bloquea ese producto por un instante mientras descuenta el stock, de modo que dos cajas no pueden vender la misma última unidad. Nunca te va a dejar el stock en negativo.',
        ],
        [
            'categoria' => 'uso',
            'pregunta' => '¿Sirve con lector de código de barras?',
            'respuesta' => 'Sí. El buscador del punto de venta acepta el código del producto, así que cualquier lector USB que escriba en el campo de búsqueda funciona: pasas el producto y se agrega al carrito. Si prefieres, también puedes buscar escribiendo el nombre.',
        ],
        [
            'categoria' => 'uso',
            'pregunta' => '¿Funciona en celular o tablet?',
            'respuesta' => 'Sí. El panel se adapta a pantallas pequeñas, así que puedes revisar tu inventario o tus ventas desde el celular. Para cobrar en el mostrador recomendamos una pantalla más grande, por comodidad. Una aplicación móvil propia está en nuestra lista de desarrollo.',
        ],
        [
            'categoria' => 'uso',
            'pregunta' => '¿Puedo vender por kilo o por metro?',
            'respuesta' => 'En parte. Puedes crear tus propias unidades de medida (kilo, metro, bolsa, galón) y asignárselas a cada producto, y así aparecen en el punto de venta. Pero hoy las cantidades se registran en números enteros, así que todavía no puedes cobrar 1.5 kilos en una sola línea. Estamos trabajando en las cantidades decimales.',
        ],
        [
            'categoria' => 'uso',
            'pregunta' => '¿Qué pasa si me equivoco al cobrar?',
            'respuesta' => 'Mientras la venta está abierta puedes cambiar cantidades, quitar un producto o vaciar el carrito completo sin ninguna consecuencia. Una vez cerrada, la venta queda registrada: la anulación de ventas ya emitidas es uno de los módulos en desarrollo. Por ahora, si necesitas corregir una, escríbenos.',
        ],

        // ---------- Usuarios y permisos ----------
        [
            'categoria' => 'usuarios',
            'pregunta' => '¿Cuántos usuarios puedo crear?',
            'respuesta' => 'Depende del plan: el plan Inicio es para un solo usuario, el plan Negocio admite hasta cinco y el plan Ferretería no tiene límite. Puedes subir de plan en cualquier momento si contratas más personal.',
        ],
        [
            'categoria' => 'usuarios',
            'pregunta' => '¿Cada trabajador ve todo el sistema?',
            'respuesta' => 'No. A cada usuario le asignas un rol, y el menú cambia según ese rol: quien atiende el mostrador entra al punto de venta, quien maneja almacén ve los módulos de almacén, y solo el administrador tiene acceso completo. Así nadie toca lo que no le corresponde.',
        ],
        [
            'categoria' => 'usuarios',
            'pregunta' => '¿Puedo saber quién hizo cada venta?',
            'respuesta' => 'Sí. Cada venta se guarda con el usuario que la registró, la fecha y la hora, además del detalle de los productos y el precio al que se vendió cada uno. Si al cierre de caja algo no cuadra, puedes rastrearlo.',
        ],

        // ---------- Datos y seguridad ----------
        [
            'categoria' => 'datos',
            'pregunta' => '¿Quién puede ver la información de mi ferretería?',
            'respuesta' => 'Solo los usuarios que tú crees dentro de tu cuenta, y cada uno según el rol que le hayas dado. Nosotros no compartimos ni vendemos tu información a nadie: tu inventario y tus márgenes son datos de tu negocio, no nuestros.',
        ],
        [
            'categoria' => 'datos',
            'pregunta' => '¿Hacen respaldo de mi información?',
            'respuesta' => 'Sí, todos los días y de forma automática. No tienes que hacer nada ni acordarte de nada. Es una de las ventajas de no tener el sistema en una sola computadora de la tienda: si esa máquina se daña, tus datos siguen intactos.',
        ],
        [
            'categoria' => 'datos',
            'pregunta' => '¿Puedo sacar mi información del sistema?',
            'respuesta' => 'Sí. Si nos la pides, te entregamos tu inventario y tu historial de ventas en un archivo que puedas abrir en Excel, sin condiciones y sin demoras. La exportación con un clic desde el propio panel está en desarrollo.',
        ],
        [
            'categoria' => 'datos',
            'pregunta' => '¿Qué pasa con mis datos si dejo de pagar?',
            'respuesta' => 'Tu cuenta queda en pausa, no se borra. No puedes registrar ventas nuevas, pero tu información se conserva y puedes pedirnos una copia o reactivar la cuenta más adelante y seguir donde la dejaste.',
        ],

        // ---------- Pagos y facturación ----------
        [
            'categoria' => 'pagos',
            'pregunta' => '¿EJJ. emite boletas y facturas electrónicas para SUNAT?',
            'respuesta' => 'Todavía no, y preferimos decirlo claro. Hoy el sistema registra cada venta con su número interno, su detalle y su total, lo que te sirve para controlar tu stock y tu caja; pero no emite comprobantes electrónicos ante SUNAT. La integración es uno de los módulos que estamos construyendo. Si facturar electrónicamente es indispensable para ti hoy, dínoslo antes de contratar.',
        ],
        [
            'categoria' => 'pagos',
            'pregunta' => '¿Necesito tarjeta de crédito para probar?',
            'respuesta' => 'No. Creas tu cuenta y tienes 14 días completos con el sistema funcionando. No pedimos datos de tarjeta para empezar, así que no hay cobros automáticos ni sorpresas al terminar la prueba.',
        ],
        [
            'categoria' => 'pagos',
            'pregunta' => '¿Cómo puedo pagar el servicio?',
            'respuesta' => 'Por transferencia bancaria, Yape o Plin. Por cada cobro te enviamos el comprobante correspondiente. Puedes pagar mes a mes o al año; si eliges el pago anual, te llevas dos meses gratis.',
        ],
        [
            'categoria' => 'pagos',
            'pregunta' => '¿Hay contrato de permanencia?',
            'respuesta' => 'No. No firmas nada que te ate ni pagas penalidad por irte. Si un mes decides que no te sirve, lo cancelas y listo. Preferimos que te quedes porque el sistema te funciona, no porque no puedas salir.',
        ],
        [
            'categoria' => 'pagos',
            'pregunta' => '¿Puedo cambiar de plan más adelante?',
            'respuesta' => 'Sí, en cualquier momento. Si subes de plan pagas solo la diferencia del periodo que te queda; si bajas, el cambio se aplica desde el siguiente ciclo de facturación.',
        ],
    ];

    // Índice liviano para que Alpine sepa si la búsqueda dejó resultados.
    $indice = array_map(fn($f) => [
        'c' => $f['categoria'],
        'b' => mb_strtolower($f['pregunta'] . ' ' . $f['respuesta']),
    ], $faqs);
@endphp

<x-public-layout title="Preguntas frecuentes">

    {{-- ===================================================== --}}
    {{-- 1. ENCABEZADO                                         --}}
    {{-- ===================================================== --}}
    <section class="relative overflow-hidden border-b border-slate-200/80 bg-surface">
        <div aria-hidden="true"
            class="pointer-events-none absolute -right-20 -top-28 h-80 w-80 rounded-full bg-primary/10 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-primary/25 bg-primary/10 px-3.5 py-1.5 text-xs font-semibold text-primary">
                    <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                    Preguntas frecuentes
                </span>

                <h1 class="mt-6 text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-950 sm:text-5xl">
                    Lo que nos preguntan<br>
                    <span class="text-primary">antes de decidirse.</span>
                </h1>

                <p class="mt-6 text-base leading-relaxed text-slate-600 sm:text-[17px]">
                    Respuestas directas, incluidas las incómodas. Si algo todavía no lo hacemos,
                    aquí lo vas a leer.
                </p>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 2. BUSCADOR + FILTROS + ACORDEÓN                      --}}
    {{-- ===================================================== --}}
    <section class="bg-white py-16 sm:py-20"
        x-data="{
            categoria: 'todas',
            busqueda: '',
            abierta: null,
            indice: {{ Js::from($indice) }},

            get hayResultados() {
                const q = this.busqueda.toLowerCase().trim();
                return this.indice.some(f =>
                    (this.categoria === 'todas' || f.c === this.categoria) &&
                    (q === '' || f.b.includes(q))
                );
            }
        }">

        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- Buscador --}}
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <input type="text" x-model="busqueda" placeholder="Busca tu pregunta: stock, SUNAT, usuarios..."
                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-sm text-slate-700 placeholder-slate-400 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none">
                <button type="button" x-show="busqueda !== ''" x-cloak @click="busqueda = ''"
                    aria-label="Limpiar búsqueda"
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 transition cursor-pointer">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Píldoras de categoría --}}
            <div class="mt-5 flex items-center gap-2 overflow-x-auto pb-1.5">
                @foreach ($categorias as $clave => $etiqueta)
                    <button type="button" @click="categoria = '{{ $clave }}'"
                        :class="categoria === '{{ $clave }}'
                            ? 'bg-primary/10 border-primary/30 text-primary font-semibold'
                            : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50'"
                        class="shrink-0 rounded-full border px-4 py-1.5 text-xs transition cursor-pointer">
                        {{ $etiqueta }}
                    </button>
                @endforeach
            </div>

            {{-- Lista de preguntas --}}
            <div class="mt-8 space-y-3">
                @foreach ($faqs as $i => $faq)
                    <div data-categoria="{{ $faq['categoria'] }}"
                        data-buscar="{{ mb_strtolower($faq['pregunta'] . ' ' . $faq['respuesta']) }}"
                        x-show="(categoria === 'todas' || $el.dataset.categoria === categoria)
                            && (busqueda.trim() === '' || $el.dataset.buscar.includes(busqueda.toLowerCase().trim()))"
                        class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white transition"
                        :class="abierta === {{ $i }} ? 'border-primary/30 shadow-[0_10px_30px_rgba(8,32,215,0.07)]' : ''">

                        <h3>
                            <button type="button" @click="abierta = abierta === {{ $i }} ? null : {{ $i }}"
                                :aria-expanded="abierta === {{ $i }}"
                                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left cursor-pointer">
                                <span class="text-sm font-semibold tracking-tight text-slate-900 sm:text-[15px]">
                                    {{ $faq['pregunta'] }}
                                </span>
                                <span
                                    :class="abierta === {{ $i }} ? 'bg-primary text-white rotate-180' : 'bg-slate-100 text-slate-500'"
                                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full transition-all duration-200">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </button>
                        </h3>

                        <div x-show="abierta === {{ $i }}" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            <p class="border-t border-slate-100 px-5 py-4 text-sm leading-relaxed text-slate-600">
                                {{ $faq['respuesta'] }}
                            </p>
                        </div>
                    </div>
                @endforeach

                {{-- Sin resultados --}}
                <div x-show="!hayResultados" x-cloak
                    class="rounded-2xl border border-dashed border-slate-300 bg-slate-50/60 px-6 py-14 text-center">
                    <p class="text-sm font-semibold text-slate-700">No encontramos esa pregunta</p>
                    <p class="mt-1.5 text-sm text-slate-500">
                        Prueba con otra palabra o
                        <a href="{{ route('contacto') }}" class="font-semibold text-primary hover:underline">
                            escríbenos directamente</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================== --}}
    {{-- 3. LLAMADA FINAL                                      --}}
    {{-- ===================================================== --}}
    <section class="border-t border-slate-200/80 bg-surface py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col items-start justify-between gap-7 rounded-3xl border border-slate-100 bg-white p-8 shadow-[0_20px_50px_rgba(8,32,215,0.06)] sm:p-10 lg:flex-row lg:items-center">

                <div class="max-w-xl">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">
                        ¿Te quedó una duda?
                    </h2>
                    <p class="mt-3 text-base leading-relaxed text-slate-600">
                        Escríbenos y te responde alguien del equipo, no un robot. Si EJJ. no es para tu
                        ferretería, también te lo vamos a decir.
                    </p>
                </div>

                <div class="flex w-full shrink-0 flex-col gap-3 sm:flex-row lg:w-auto">
                    <a href="{{ route('contacto') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                        Contáctanos
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-6 py-3.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition">
                        Probar gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
