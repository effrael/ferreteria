<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\UnidadMedida;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->input('buscar');

        $productos = Producto::with(['marca', 'categoria', 'unidadmedida'])
            ->where('nombre', 'like', "%{$buscar}%")
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = UnidadMedida::orderBy('nombre')->get();

        return view('inventario', compact('productos', 'categorias', 'marcas', 'unidades'));
    }

    public function create(): View
    {
        $producto = new Producto(['estado' => true]);
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = UnidadMedida::orderBy('nombre')->get();

        return view('admin.productos.create', compact('producto', 'categorias', 'marcas', 'unidades'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validar($request);
        Producto::create($datos);

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    public function show(Producto $inventario): View
    {
        return view('admin.productos.show', ['producto' => $inventario]);
    }

    public function edit(Producto $inventario): View
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        $unidades = UnidadMedida::orderBy('nombre')->get();

        return view('admin.productos.edit', [
            'producto' => $inventario,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'unidades' => $unidades,
        ]);
    }

    public function update(Request $request, Producto $inventario): RedirectResponse
    {
        $datos = $this->validar($request, $inventario);
        $inventario->update($datos);

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $inventario): RedirectResponse
    {
        $inventario->update(['estado' => false]);

        return redirect()->route('admin.inventario.index')
            ->with('success', "El producto «{$inventario->nombre}» fue desactivado.");
    }

    private function validar(Request $request, ?Producto $producto = null): array
    {
        return $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',
                Rule::unique('productos', 'nombre')->ignore($producto),
            ],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'precio' => ['required', 'numeric', 'min:0.1', 'max:999999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'imagen' => ['nullable', 'regex:/^[\w-]+\.(png|jpe?g|webp)$/i'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            // Si también envías marca y unidad de medida en tu formulario, descomenta estas dos líneas:
            // 'marca_id' => ['required', 'exists:marcas,id'],
            // 'unidad_medida_id' => ['required', 'exists:unidad_medidas,id'],
            'destacado' => ['boolean'],
            'estado' => ['boolean'],
        ], [], [
            'categoria_id' => 'categoría',
        ]);
    }
}