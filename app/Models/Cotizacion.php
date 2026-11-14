<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Table('cotizaciones')]
#[Fillable([
    'codigo',
    'user_id',
    'cliente_documento',
    'cliente_nombre',
    'cliente_contacto',
    'subtotal',
    'descuento',
    'envio',
    'igv',
    'total',
    'estado',
])]
class Cotizacion extends Model
{
    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'descuento' => 'decimal:2',
            'envio' => 'decimal:2',
            'igv' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CotizacionDetalle::class, 'cotizacion_id');
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // La venta (orden de venta) que se genera al confirmar el pago.
    public function venta(): HasOne
    {
        return $this->hasOne(Ventas::class, 'cotizacion_id');
    }
}
