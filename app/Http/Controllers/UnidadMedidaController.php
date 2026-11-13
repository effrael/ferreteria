<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:unidadmedidas,nombre'],
        ]);

        $unidad = UnidadMedida::create($datos);

        if ($request->wantsJson()) {
            return response()->json($unidad, 201);
        }

        return redirect()->back()->with('success', 'Unidad de medida creada correctamente.');
    }
}