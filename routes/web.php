<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\MetodosPagoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

<<<<<<< HEAD
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
=======
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
>>>>>>> 8220b6d71f8630837cfcce2e4aa2c4e706df419f

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
<<<<<<< HEAD
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
=======
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
>>>>>>> 8220b6d71f8630837cfcce2e4aa2c4e706df419f
    });

require __DIR__ . '/auth.php';