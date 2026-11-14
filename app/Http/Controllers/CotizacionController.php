<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\MetodoPago;
use App\Models\Producto;
use App\Models\Ventas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CotizacionController extends Controller
{
    // IGV del 18 %. Se aplica sobre (subtotal - descuento).
    private const IGV = 0.18;

    /* 
     | LISTADO
     * */
    public function index(): View
    {
        $cotizaciones = Cotizacion::with('vendedor')
            ->latest()
            ->paginate(10);

        return view('cotizaciones.index', compact('cotizaciones'));
    }

    /* 
     | formulario "Generar cotización"
     *  */
    public function create(): View
    {
        // Los productos vienen del módulo Inventario.
        $productos = Producto::with('unidadmedida')
            ->where('estado', true)
            ->where('stock', '>', 0)
            ->orderBy('nombre')
            ->get();

        $codigo = 'COT-' . str_pad((string) ((Cotizacion::max('id') ?? 0) + 1), 5, '0', STR_PAD_LEFT);

        return view('cotizaciones.create', compact('productos', 'codigo'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'cliente_documento' => ['nullable', 'string', 'max:20'],
            'cliente_nombre' => ['nullable', 'string', 'max:150'],
            'cliente_contacto' => ['nullable', 'string', 'max:150'],
            'descuento' => ['nullable', 'numeric', 'min:0'],
            'envio' => ['nullable', 'numeric', 'min:0'],
            'accion' => ['nullable', 'in:guardar,pago'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.producto_id' => ['required', 'integer', 'exists:productos,id'],
            'items.*.cantidad' => ['required', 'integer', 'min:1'],
        ], [
            'items.required' => 'Agrega al menos un producto a la cotización.',
        ]);

        // Si el mismo producto llega dos veces, sumamos las cantidades.
        $cantidades = [];
        foreach ($datos['items'] as $item) {
            $id = (int) $item['producto_id'];
            $cantidades[$id] = ($cantidades[$id] ?? 0) + (int) $item['cantidad'];
        }

        $cotizacion = DB::transaction(function () use ($datos, $cantidades, $request) {
            $productos = Producto::whereIn('id', array_keys($cantidades))->get()->keyBy('id');

            $lineas = [];
            $subtotal = 0.0;

            foreach ($cantidades as $productoId => $cantidad) {
                $producto = $productos->get($productoId);

                if (! $producto->estado) {
                    throw ValidationException::withMessages([
                        'items' => "El producto {$producto->nombre} está inactivo.",
                    ]);
                }

                if ($producto->stock < $cantidad) {
                    throw ValidationException::withMessages([
                        'items' => "Stock insuficiente de {$producto->nombre}: quedan {$producto->stock}.",
                    ]);
                }

                // El precio SIEMPRE se toma de la base de datos, nunca del navegador.
                $precio = (float) $producto->precioventa;
                $lineaSubtotal = round($precio * $cantidad, 2);
                $subtotal += $lineaSubtotal;

                $lineas[] = [
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $lineaSubtotal,
                ];
            }

            $subtotal = round($subtotal, 2);
            $descuento = round((float) ($datos['descuento'] ?? 0), 2);
            $envio = round((float) ($datos['envio'] ?? 0), 2);

            if ($descuento > $subtotal) {
                throw ValidationException::withMessages([
                    'descuento' => 'El descuento no puede ser mayor al subtotal.',
                ]);
            }

            $igv = round(($subtotal - $descuento) * self::IGV, 2);
            $total = round($subtotal - $descuento + $envio + $igv, 2);

            $cotizacion = Cotizacion::create([
                'codigo' => $this->siguienteCodigo(),
                'user_id' => $request->user()->id,
                'cliente_documento' => $datos['cliente_documento'] ?? null,
                'cliente_nombre' => $datos['cliente_nombre'] ?: 'Público general',
                'cliente_contacto' => $datos['cliente_contacto'] ?? null,
                'subtotal' => $subtotal,
                'descuento' => $descuento,
                'envio' => $envio,
                'igv' => $igv,
                'total' => $total,
                'estado' => 'borrador',
            ]);

            foreach ($lineas as $linea) {
                $cotizacion->detalles()->create($linea);
            }

            return $cotizacion;
        });

        if (($datos['accion'] ?? 'guardar') === 'pago') {
            return redirect()->route('admin.cotizaciones.pago', $cotizacion);
        }

        return redirect()->route('admin.cotizaciones.show', $cotizacion)
            ->with('success', "Cotización {$cotizacion->codigo} guardada correctamente.");
    }

    /* 
     |  DETALLE y ELIMINAR
     * */
    public function show(Cotizacion $cotizacion): View
    {
        $cotizacion->load(['detalles.producto', 'vendedor', 'venta']);

        return view('cotizaciones.show', compact('cotizacion'));
    }

    public function destroy(Cotizacion $cotizacion): RedirectResponse
    {
        if ($cotizacion->estado !== 'borrador') {
            return redirect()->route('admin.cotizaciones.index')
                ->withErrors(['cotizacion' => 'Solo se pueden eliminar cotizaciones en borrador.']);
        }

        $codigo = $cotizacion->codigo;
        $cotizacion->delete(); // los detalles se borran solos (cascadeOnDelete)

        return redirect()->route('admin.cotizaciones.index')
            ->with('success', "Cotización {$codigo} eliminada.");
    }

    /* 
     | "Procesar pago"
     * */
    public function pago(Cotizacion $cotizacion): View|RedirectResponse
    {
        if ($cotizacion->estado !== 'borrador') {
            return redirect()->route('admin.cotizaciones.orden', $cotizacion);
        }

        $cotizacion->load('detalles.producto');

        // Los métodos de pago salen de la base de datos (módulo Métodos de pago).
        $metodos = MetodoPago::where('estado', true)->orderBy('id')->get();

        return view('cotizaciones.pago', compact('cotizacion', 'metodos'));
    }

    public function confirmarPago(Request $request, Cotizacion $cotizacion): RedirectResponse
    {
        if ($cotizacion->estado !== 'borrador') {
            return redirect()->route('admin.cotizaciones.orden', $cotizacion);
        }

        $datos = $request->validate([
            'metodo_pago_id' => ['required', 'exists:metodo_pagos,id'],
            'monto_recibido' => ['nullable', 'numeric', 'min:0'],
        ], [], [
            'metodo_pago_id' => 'método de pago',
            'monto_recibido' => 'monto recibido',
        ]);

        $metodo = MetodoPago::findOrFail($datos['metodo_pago_id']);
        $total = (float) $cotizacion->total;
        $esEfectivo = mb_strtolower($metodo->nombre) === 'efectivo';

        // Solo en efectivo hay "monto recibido" y "vuelto". Pago simulado en los demás.
        $recibido = $esEfectivo ? round((float) ($datos['monto_recibido'] ?? 0), 2) : $total;

        if ($recibido < $total) {
            throw ValidationException::withMessages([
                'monto_recibido' => 'El monto recibido es menor al total a pagar.',
            ]);
        }

        $vuelto = round($recibido - $total, 2);

        DB::transaction(function () use ($cotizacion, $metodo, $recibido, $vuelto, $request) {
            $cotizacion->load('detalles');

            // lockForUpdate: evita que dos ventas simultáneas dejen el stock negativo.
            $productos = Producto::whereIn('id', $cotizacion->detalles->pluck('producto_id'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            foreach ($cotizacion->detalles as $detalle) {
                $producto = $productos->get($detalle->producto_id);

                if (! $producto->estado || $producto->stock < $detalle->cantidad) {
                    throw ValidationException::withMessages([
                        'metodo_pago_id' => "Stock insuficiente de {$producto->nombre}: quedan {$producto->stock}.",
                    ]);
                }
            }

            // La orden de venta es un registro de la tabla "ventas".
            $venta = Ventas::create([
                'numero' => $this->siguienteNumeroVenta(),
                'user_id' => $request->user()->id,
                'cliente_id' => null,
                'cotizacion_id' => $cotizacion->id,
                'metodo_pago' => $metodo->nombre,
                'subtotal' => $cotizacion->subtotal,
                'descuento' => $cotizacion->descuento,
                'envio' => $cotizacion->envio,
                'igv' => $cotizacion->igv,
                'total' => $cotizacion->total,
                'monto_recibido' => $recibido,
                'vuelto' => $vuelto,
                'estado' => true,
            ]);

            foreach ($cotizacion->detalles as $detalle) {
                $venta->detalles()->create([
                    'producto_id' => $detalle->producto_id,
                    'cantidad' => $detalle->cantidad,
                    'precio' => $detalle->precio,
                    'subtotal' => $detalle->subtotal,
                ]);

                $productos->get($detalle->producto_id)->decrement('stock', $detalle->cantidad);
            }

            $cotizacion->update(['estado' => 'pagada']);
        });

        return redirect()->route('admin.cotizaciones.orden', $cotizacion);
    }

    /* 
     | "Orden de venta registrada"
     * */
    public function orden(Cotizacion $cotizacion): View|RedirectResponse
    {
        $cotizacion->load(['venta.vendedor', 'detalles.producto']);

        if (! $cotizacion->venta) {
            return redirect()->route('admin.cotizaciones.pago', $cotizacion);
        }

        return view('cotizaciones.orden', compact('cotizacion'));
    }

    /* 
     | Correlativos
     * */
    private function siguienteCodigo(): string
    {
        $ultimo = Cotizacion::lockForUpdate()->max('id') ?? 0;

        return 'COT-' . str_pad((string) ($ultimo + 1), 5, '0', STR_PAD_LEFT);
    }

    private function siguienteNumeroVenta(): string
    {
        $ultimo = Ventas::lockForUpdate()->max('id') ?? 0;

        return 'V-' . str_pad((string) ($ultimo + 1), 8, '0', STR_PAD_LEFT);
    }
}
