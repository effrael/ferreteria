<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->input('buscar');
        $filtro = $request->input('filtro', 'todos');

        $usuarios = User::query()
            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%")
                      ->orWhere('email', 'like', "%{$buscar}%")
                      ->orWhere('role', 'like', "%{$buscar}%");
                });
            })
            ->when($filtro === 'activos', fn ($q) => $q->where('estado', true))
            ->when($filtro === 'inactivos', fn ($q) => $q->where('estado', false))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('usuarios.index', compact('usuarios', 'filtro'));
    }

    public function create(): View
    {
        $user = new User([
            'role'   => 'cliente',
            'estado' => true,
        ]);

        return view('usuarios.create', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validar($request);

        if ($datos['role'] === 'cliente') {
            $datos['password'] = Str::random(16);
        }

        $user = User::create($datos);
        $this->sincronizarRolSpatie($user, $datos['role']);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Registro creado correctamente.');
    }

    public function show(User $user): View
    {
        return view('usuarios.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $datos = $this->validar($request, $user);

        if (empty($datos['password'])) {
            unset($datos['password']);
        }

        $user->update($datos);
        $this->sincronizarRolSpatie($user, $datos['role']);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.usuarios.index')
                ->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        $nuevoEstado = ! $user->estado;
        $user->update(['estado' => $nuevoEstado]);

        $accion = $nuevoEstado ? 'activado' : 'desactivado';

        return redirect()->route('admin.usuarios.index')
            ->with('success', "El usuario «{$user->name}» fue {$accion}.");
    }

    private function validar(Request $request, ?User $user = null): array
    {
        $esCliente = $request->input('role') === 'cliente';

        return $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'role'     => ['required', Rule::in(['administrador', 'vendedor', 'almacenero', 'cliente'])],
            'password' => [
                ($user || $esCliente) ? 'nullable' : 'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'estado'   => ['boolean'],
        ], [], [
            'name'     => 'nombre',
            'email'    => 'correo electrónico',
            'role'     => 'rol',
            'password' => 'contraseña',
        ]);
    }

    private function sincronizarRolSpatie(User $user, string $rol): void
    {
        if (Role::where('name', $rol)->where('guard_name', 'web')->exists()) {
            $user->syncRoles([$rol]);
        }
    }
}