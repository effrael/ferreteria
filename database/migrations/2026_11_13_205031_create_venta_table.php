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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero', 20)->unique();          // comprobante: V-00000123

            $table->foreignId('user_id')                      // quién vendió
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('cliente_id')                   // nullable = público general
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /**
             *  $table->foreignId('metodopago_id')
                ->constrained('metodopagos')
                ->restrictOnDelete();
             */
            $table->decimal('subtotal', 10, 2);
            $table->decimal('igv', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
