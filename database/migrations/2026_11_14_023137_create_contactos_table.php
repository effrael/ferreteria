<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Mensajes enviados desde el formulario público de Contacto.
     */
    public function up(): void
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 100);
            $table->string('ferreteria', 100)->nullable();   // puede escribir alguien sin ferretería aún
            $table->string('email', 150);
            $table->string('telefono', 20)->nullable();

            $table->enum('tipo', ['demo', 'precios', 'soporte', 'otro'])
                ->default('otro');

            $table->text('mensaje');

            $table->boolean('atendido')->default(false);     // para darle seguimiento, no se borra
            $table->timestamps();

            $table->index(['atendido', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
