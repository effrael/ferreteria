<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->input('buscar');

        $clientes = Cliente::query()
            ->where(function ($query) use ($buscar) {
                $query->where('nombre', 'like', "%{$buscar}%")
                      ->orWhere('documento', 'like', "%{$buscar}%");
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('admin.clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        $cliente = new Cliente(['estado' => true]);

        return view('admin.clientes.create', compact('cliente'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validar($request);
        Cliente::create($datos);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    public function show(Cliente $cliente): View
    {
        return view('admin.clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente): View
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente): RedirectResponse
    {
        $datos = $this->validar($request, $cliente);
        $cliente->update($datos);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        // Eliminación lógica: no se borra el registro de la BD
        $cliente->update(['estado' => false]);

        return redirect()->route('admin.clientes.index')
            ->with('success', "El cliente «{$cliente->nombre}» fue desactivado.");
    }

    private function validar(Request $request, ?Cliente $cliente = null): array
    {
        return $request->validate([
            'nombre'    => ['required', 'string', 'max:150'],
            'documento' => ['nullable', 'string', 'max:20', Rule::unique('clientes', 'documento')->ignore($cliente)],
            'telefono'  => ['nullable', 'string', 'max:20'],
            'email'     => ['nullable', 'email', 'max:150'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'estado'    => ['boolean'],
        ], [], [
            'documento' => 'DNI / RUC',
            'direccion' => 'dirección',
        ]);
    }
}