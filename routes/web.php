<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('home')->name('home.')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::resource('categorias', CategoriasController::class);
});


