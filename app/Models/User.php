<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'role', 'estado'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
<<<<<<< HEAD
=======
     * ¿Este usuario puede entrar al panel de administración?
     */
    public function tieneAccesoAlPanel(): bool
    {
        return in_array($this->role, ['administrador', 'vendedor'], true)
            && ($this->estado ?? true);
    }

    /**
     * Ruta a la que entra el usuario después de iniciar sesión, según su rol.
     * Los roles sin acceso al panel van a la página pública.
     */
    public function rutaInicio(): string
    {
        return match ($this->role) {
            'administrador', 'vendedor' => route('admin.ventas.index', absolute: false),
            default => route('home', absolute: false),
        };
    }

    /**
>>>>>>> 8220b6d71f8630837cfcce2e4aa2c4e706df419f
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'estado' => 'boolean',
        ];
    }

    public function tieneRol(string ...$roles): bool
    {
        return in_array($this->role, $roles);
    }
}