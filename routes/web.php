<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categorias\CategoriasController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediosDePagoController;
use App\Models\Pedidos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome.index');
// Rutas de autenticación
Auth::routes();

Route::middleware(['auth'])->prefix('home')->name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::resource('categorias', CategoriasController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('mesas', MesaController::class);
    Route::resource('pedidos', PedidosController::class);
    Route::resource('empleados', EmpleadoController::class)->middleware('admin');
    Route::resource('medios-de-pago', MediosDePagoController::class);
});

// Ruta de prueba fuera del grupo con middleware
Route::get('/test-relacion', function() {
    $pedido = Pedidos::with('estado')->first();
    
    if ($pedido && $pedido->estado) {
        dd($pedido->estado->descripcion);
    } else {
        dd("No se encontró el pedido o no tiene estado asignado");
    }
});






