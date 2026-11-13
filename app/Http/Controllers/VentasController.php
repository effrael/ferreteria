<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Ventas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VentasController extends Controller
{
    public function index(): View
    {
        $productos = Producto::with('unidadmedida')
            ->where('estado', true)
            ->orderBy('nombre')
            ->get();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('ventas', compact('productos', 'categorias'));
    }

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.producto_id' => ['required', 'integer', 'exists:productos,id'],
            'items.*.cantidad' => ['required', 'integer', 'min:1'],
        ], [
            'items.required' => 'No hay productos en la venta.',
        ]);

        // Agrupamos por producto: si el carrito manda el mismo id dos veces,
        // se cobra y se descuenta una sola vez la suma de las cantidades.
        $cantidades = [];
        foreach ($datos['items'] as $item) {
            $id = (int) $item['producto_id'];
            $cantidades[$id] = ($cantidades[$id] ?? 0) + (int) $item['cantidad'];
        }

        $venta = DB::transaction(function () use ($cantidades, $request) {
            // lockForUpdate bloquea estas filas hasta cerrar la transacción:
            // sin esto, dos cajas vendiendo a la vez pueden dejar el stock negativo.
            $productos = Producto::whereIn('id', array_keys($cantidades))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $lineas = [];
            $subtotal = '0.00';

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

                // El precio se toma de la base de datos, nunca del navegador.
                $precio = $producto->precioventa;
                $lineaSubtotal = bcmul((string) $precio, (string) $cantidad, 2);
                $subtotal = bcadd($subtotal, $lineaSubtotal, 2);

                $lineas[] = [
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $lineaSubtotal,
                ];
            }

            $venta = Ventas::create([
                'numero' => $this->siguienteNumero(),
                'user_id' => $request->user()->id,
                'cliente_id' => null,       // por ahora todas las ventas son público general
                'subtotal' => $subtotal,
                'igv' => '0.00',            // operaciones exoneradas
                'total' => $subtotal,
                'estado' => true,
            ]);

            foreach ($lineas as $linea) {
                $venta->detalles()->create($linea);
                $productos->get($linea['producto_id'])->decrement('stock', $linea['cantidad']);
            }

            return $venta;
        });

        return response()->json([
            'mensaje' => "Venta {$venta->numero} registrada por S/ {$venta->total}.",
            'venta' => [
                'id' => $venta->id,
                'numero' => $venta->numero,
                'total' => $venta->total,
            ],
        ], 201);
    }

    /**
     * Correlativo del comprobante: V-00000001, V-00000002, ...
     * Se llama dentro de la transacción del store().
     */
    private function siguienteNumero(): string
    {
        $ultimo = Ventas::lockForUpdate()->max('id') ?? 0;

        return 'V-' . str_pad((string) ($ultimo + 1), 8, '0', STR_PAD_LEFT);
    }
}
