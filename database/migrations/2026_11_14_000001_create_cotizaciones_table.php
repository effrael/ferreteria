<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo', 20)->unique();            // COT-00001

            $table->foreignId('user_id')                        // vendedor que la creó
                ->constrained('users')
                ->restrictOnDelete();

            // Datos del cliente (copia escrita en el momento de cotizar)
            $table->string('cliente_documento', 20)->nullable();
            $table->string('cliente_nombre', 150)->nullable();
            $table->string('cliente_contacto', 150)->nullable();

            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('envio', 10, 2)->default(0);
            $table->decimal('igv', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->string('estado', 20)->default('borrador');  // borrador | pagada
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
