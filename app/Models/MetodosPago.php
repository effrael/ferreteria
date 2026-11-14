<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('metodos_pagos')]
#[Fillable([
    'nombre',
    'estado',
])]
class MetodosPago extends Model
{
    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }
}