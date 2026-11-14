<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->foreignId('cotizacion_id')
                ->nullable()
                ->after('cliente_id')
                ->constrained('cotizaciones')
                ->nullOnDelete();

            $table->string('metodo_pago', 50)->nullable()->after('cotizacion_id');
            $table->decimal('descuento', 10, 2)->default(0)->after('subtotal');
            $table->decimal('envio', 10, 2)->default(0)->after('descuento');
            $table->decimal('monto_recibido', 10, 2)->nullable()->after('total');
            $table->decimal('vuelto', 10, 2)->default(0)->after('monto_recibido');
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cotizacion_id');
            $table->dropColumn(['metodo_pago', 'descuento', 'envio', 'monto_recibido', 'vuelto']);
        });
    }
};
