<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
#[Fillable([
    'nombre',
    'codigo',
    'marca_id',
    'categoria_id',
    'unidad_id',
    'precioventa',
    'preciocompra',
    'stock',
    'descripcion',
    'imagen',
    'estado',
])]
class Producto extends Model
{

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2', // "1299.00"
            'precioventa' => 'decimal:2', // "1299.00"
            'preciocompra' => 'decimal:2', // "1299.00"
            'stock' => 'integer', // 3
            'estado' => 'boolean', // true = activo, false = inactivo
        ];
    }
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }
    public function unidadmedida(): BelongsTo
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_id');
    }
}
