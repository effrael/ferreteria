<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Si tu compañero del módulo "Métodos de pago" ya creó la tabla, no hacemos nada.
        if (Schema::hasTable('metodo_pagos')) {
            return;
        }

        Schema::create('metodo_pagos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50)->unique();
            $table->boolean('estado')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metodo_pagos');
    }
};
