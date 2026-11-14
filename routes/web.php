<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\MetodosPagoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // ... rutas existentes de ventas, vender, inventario, etc.
    Route::resource('usuarios', UserController::class)
        ->parameters(['usuarios' => 'user']);
});
// ===== Sitio público: Home y páginas informativas =====
// Sin middleware 'guest': deben verse con o sin sesión iniciada.
Route::controller(PaginaController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/nosotros', 'nosotros')->name('nosotros');
    Route::get('/precios', 'precios')->name('precios');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/contacto', 'contacto')->name('contacto');

    // throttle: máximo 5 envíos por minuto desde la misma IP, para evitar spam.
    Route::post('/contacto', 'enviarContacto')
        ->middleware('throttle:5,1')
        ->name('contacto.store');
});

// El dashboard se eliminó: tras iniciar sesión, cada usuario entra
// a la ruta que le corresponde según su rol (ver User::rutaInicio()).

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
        // Punto de venta: la pantalla donde se cobra.
        Route::get('vender', [VentasController::class, 'vender'])->name('vender.index');

        // Comprobantes: listado y registro de la venta.
        // Rutas explícitas en vez de resource, para no exponer métodos que no existen.
        Route::get('ventas', [VentasController::class, 'index'])->name('ventas.index');
       Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'user']);
        Route::post('ventas', [VentasController::class, 'store'])->name('ventas.store');
        Route::resource('categorias', CategoriaController::class);
        Route::resource('marcas', MarcaController::class);
        Route::resource('unidades', UnidadMedidaController::class);
        Route::resource('metodos-pago', MetodosPagoController::class)->parameters(['metodos-pago' => 'metodosPago']);
    });

require __DIR__ . '/auth.php';