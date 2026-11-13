<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('venta_id')
                ->constrained('ventas')
                ->cascadeOnDelete();                          // se va la venta, se van sus líneas

            $table->foreignId('producto_id')
                ->constrained('productos')
                ->restrictOnDelete();                         // no borrar un producto ya vendido

            $table->integer('cantidad')->unsigned();
            $table->decimal('precio', 8, 2);                  // copia del precio al momento de vender
            $table->decimal('subtotal', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
