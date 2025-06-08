<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categorias\CategoriasController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome.index');
// Rutas de autenticación
Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('home')->name('home.')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::resource('categorias', CategoriasController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('mesas', MesaController::class);
    Route::resource('empleados', EmpleadoController::class);
    
});


