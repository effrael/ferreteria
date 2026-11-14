<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('metodo_pagos')]
#[Fillable(['nombre', 'estado'])]
class MetodoPago extends Model
{
    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }
}
