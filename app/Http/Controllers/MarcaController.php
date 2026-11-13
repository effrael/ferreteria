<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:marcas,nombre'],
        ]);

        $marca = Marca::create($datos);

        if ($request->wantsJson()) {
            return response()->json($marca, 201);
        }

        return redirect()->back()->with('success', 'Marca creada correctamente.');
    }
}