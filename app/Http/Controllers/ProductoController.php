<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\UnidadMedida;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(): View
    {
        $esAdmin = auth()->user()->role === 'administrador';

        $productos = Producto::with(['marca', 'categoria', 'unidadmedida'])
            ->when(!$esAdmin, fn($query) => $query->where('estado', true))
            ->orderBy('nombre')
            ->paginate(10);

        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = UnidadMedida::orderBy('nombre')->get();

        return view('inventario', compact('productos', 'categorias', 'marcas', 'unidades'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validar($request);
        $datos['estado'] = true;

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($datos);

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    public function update(Request $request, Producto $inventario): RedirectResponse
    {
        $datos = $this->validar($request, $inventario);

        if ($request->hasFile('imagen')) {
            if ($inventario->imagen) {
                Storage::disk('public')->delete($inventario->imagen);
            }
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $inventario->update($datos);

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

  public function destroy(Producto $inventario): RedirectResponse
    {
        $nuevoEstado = !$inventario->estado;
        $inventario->update(['estado' => $nuevoEstado]);

        $accion = $nuevoEstado ? 'activado' : 'desactivado';

        return redirect()->route('admin.inventario.index')
            ->with('success', "El producto «{$inventario->nombre}» fue {$accion}.");
    }

    private function validar(Request $request, ?Producto $producto = null): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:150', Rule::unique('productos', 'nombre')->ignore($producto)],
            'codigo' => ['nullable', 'string', 'max:50', Rule::unique('productos', 'codigo')->ignore($producto)],
            'marca_id' => ['nullable', 'exists:marcas,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'unidad_id' => ['nullable', 'exists:unidadmedidas,id'],
            'precioventa' => ['required', 'numeric', 'min:0.1', 'max:999999.99'],
            'preciocompra' => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'imagen' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'estado' => ['nullable', 'boolean'],
        ], [], [
            'categoria_id' => 'categoría',
            'marca_id' => 'marca',
            'unidad_id' => 'unidad de medida',
            'precioventa' => 'precio de venta',
            'preciocompra' => 'precio de compra',
        ]);
    }
    public function storeCategoria(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:categorias,nombre'],
        ]);

        $categoria = Categoria::create($datos);

        return response()->json($categoria, 201);
    }

    public function storeMarca(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:marcas,nombre'],
        ]);

        $marca = Marca::create($datos);

        return response()->json($marca, 201);
    }

    public function storeUnidad(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:unidad_medidas,nombre'],
        ]);

        $unidad = UnidadMedida::create($datos);

        return response()->json($unidad, 201);
    }
}