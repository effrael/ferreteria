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
    public function buscar(Request $request)
    {
        $texto = $request->query('texto', '');
        return Categoria::where('nombre', 'like', "%{$texto}%")->get();
    }
}
