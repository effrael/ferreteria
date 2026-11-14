<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login', [
        'canResetPassword' => Route::has('password.request'),
        'status' => session('status'),
    ]);
})->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== Sección Administración (solo administradores) =====
Route::middleware(['auth', 'role:administrador,vendedor'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('inventario', ProductoController::class);
        Route::resource('ventas', VentasController::class);
        Route::resource('categorias', CategoriaController::class);
        Route::resource('marcas', MarcaController::class);
        Route::resource('unidades', UnidadMedidaController::class);

        // Cotizaciones (las rutas personalizadas van ANTES del resource)
        Route::get('cotizaciones/{cotizacion}/pago', [CotizacionController::class, 'pago'])->name('cotizaciones.pago');
        Route::post('cotizaciones/{cotizacion}/pago', [CotizacionController::class, 'confirmarPago'])->name('cotizaciones.pago.confirmar');
        Route::get('cotizaciones/{cotizacion}/orden', [CotizacionController::class, 'orden'])->name('cotizaciones.orden');
        Route::resource('cotizaciones', CotizacionController::class)
            ->parameters(['cotizaciones' => 'cotizacion'])
            ->only(['index', 'create', 'store', 'show', 'destroy']);
    });

require __DIR__ . '/auth.php';