<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categorias\CategoriasController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


/*PARA ABRIR LA CARTA (ELVIS) */
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome.index');

/*--------------------------------------------------------------------------- */
/*CARTA DAVID CON OTRA BD */

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\PedidoController;

Route::get('/mesa/{mesa}', [CartaController::class, 'mostrarCarta']);
Route::post('/mesa/{mesa}/ingresar-dni', [ClienteController::class, 'iniciarSesionCliente'])->name('cliente.iniciar');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');


Route::post('/carrito/agregar', [CartaController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::post('/carrito/confirmar', [CartaController::class, 'confirmarCarrito'])->name('carrito.confirmar');


Route::get('/visor', [PedidoController::class, 'visor'])->name('visor.visor');
Route::post('/pedido/{id}/marcar-listo', [PedidoController::class, 'marcarListo'])->name('pedido.marcarListo');

use App\Http\Controllers\ComprobanteController;
Route::post('/pedir-comprobante', [ComprobanteController::class, 'solicitar'])->name('pedir.comprobante');

use App\Http\Controllers\ComprobantesVisorController;
Route::get('/visor_comprobantes', [ComprobantesVisorController::class, 'visor'])->name('visor.visor_comprobantes');
Route::post('/comprobante/{id}/marcar-listo', [ComprobantesVisorController::class, 'marcarListo'])->name('comprobante.marcarListo');


/*--------------------------------------------------------------------------------------------------------*/

// Rutas de autenticación
Auth::routes();
Route::middleware(['auth', 'admin'])->prefix('home')->name('home.')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::resource('categorias', CategoriasController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('mesas', MesaController::class);
});


