<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Efectivo', 'Yape', 'Plin', 'Transferencia bancaria'] as $nombre) {
            MetodoPago::firstOrCreate(['nombre' => $nombre], ['estado' => true]);
        }
    }
}
