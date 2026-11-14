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

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    /**
     * Ruta a la que entra el usuario después de iniciar sesión, según su rol.
     * Los roles sin acceso al panel van a la página pública.
     */
    /**
     * ¿Este usuario puede entrar al panel de administración?
     */
    public function tieneAccesoAlPanel(): bool
    {
        return in_array($this->role, ['administrador', 'vendedor'], true);
    }

    public function rutaInicio(): string
    {
        return match ($this->role) {
            'administrador', 'vendedor' => route('admin.ventas.index', absolute: false),
            default => route('home', absolute: false),
        };
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function tieneRol(string ...$roles): bool
    {
        return in_array($this->role, $roles);
    }
}
