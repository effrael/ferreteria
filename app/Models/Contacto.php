<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nombre',
    'ferreteria',
    'email',
    'telefono',
    'tipo',
    'mensaje',
])]
class Contacto extends Model
{
    protected function casts(): array
    {
        return [
            'atendido' => 'boolean',
        ];
    }

    /**
     * Etiqueta legible del tipo de consulta, para el panel.
     */
    public function tipoLegible(): string
    {
        return match ($this->tipo) {
            'demo' => 'Solicita una demostración',
            'precios' => 'Consulta por planes y precios',
            'soporte' => 'Soporte técnico',
            default => 'Otra consulta',
        };
    }
}
