<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $categories = Categoria::orderBy('nombre')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:categorias,nombre'],
        ]);

        $categoria = Categoria::create($datos);

        if ($request->wantsJson()) {
            return response()->json($categoria, 201);
        }

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }
}
