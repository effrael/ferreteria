<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'clientes';

    // Ajusta estos nombres si tu tabla en MySQL usa otras columnas (ej. dni, ruc, apellidos)
    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'email',
        'direccion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    // Filtra solo los clientes activos (eliminación lógica)
    public function scopeActivos(Builder $query): Builder
    {
        return $query->where('estado', true);
    }

    // Relación con el modelo Ventas
    public function ventas(): HasMany
    {
        return $this->hasMany(Ventas::class, 'cliente_id');
    }
}