<?php

namespace App\Http\Controllers;

use App\Models\MetodosPago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MetodosPagoController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->input('buscar');

        $metodosPago = MetodosPago::where('nombre', 'like', "%{$buscar}%")
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('admin.metodos-pago.index', compact('metodosPago'));
    }

    public function create(): View
    {
        $metodosPago = new MetodosPago(['estado' => true]);

        return view('admin.metodos-pago.create', compact('metodosPago'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validar($request);
        MetodosPago::create($datos);

        return redirect()->route('admin.metodos-pago.index')
            ->with('success', 'Método de pago registrado correctamente.');
    }

    public function show(MetodosPago $metodosPago): View
    {
        return view('admin.metodos-pago.show', compact('metodosPago'));
    }

    public function edit(MetodosPago $metodosPago): View
    {
        return view('admin.metodos-pago.edit', compact('metodosPago'));
    }

    public function update(Request $request, MetodosPago $metodosPago): RedirectResponse
    {
        $datos = $this->validar($request, $metodosPago);
        $metodosPago->update($datos);

        return redirect()->route('admin.metodos-pago.index')
            ->with('success', 'Método de pago actualizado correctamente.');
    }

    public function destroy(MetodosPago $metodosPago): RedirectResponse
    {
        $metodosPago->update(['estado' => false]);

        return redirect()->route('admin.metodos-pago.index')
            ->with('success', "El método de pago «{$metodosPago->nombre}» fue desactivado.");
    }

    private function validar(Request $request, ?MetodosPago $metodosPago = null): array
    {
        return $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('metodos_pagos', 'nombre')->ignore($metodosPago),
            ],
            'estado' => ['boolean'],
        ]);
    }
    }