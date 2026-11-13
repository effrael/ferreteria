<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre'])]
class Marca extends Model
{
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}