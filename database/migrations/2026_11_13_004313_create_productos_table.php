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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('codigo', 100);

            $table->foreignId('marca_id')
                ->constrained('marcas')
                ->restrictOnDelete();

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->restrictOnDelete();

            $table->foreignId('unidad_id')
                ->constrained('unidadmedidas')
                ->restrictOnDelete();
            $table->decimal('precioventa', 8, 2);
            $table->decimal('preciocompra', 8, 2);
            $table->integer('stock')->unsigned()->default(0);

            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
