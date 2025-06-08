<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartaController extends Controller
{
    public function mostrarCarta($mesa)
    {
        // Verificar si ya hay sesión activa

        //si NO el dni ingresado ya tiene una Session  O en Session mesa no es igual a la mesa de la pag
        if (!session()->has('cliente_id') || session('mesa') != $mesa) {
            return view('carta.ingresar_dni', ['mesa' => $mesa]);
        }

        //jala del Model Producto
        $productos = Producto::all();

        //si lo de arriba ocurre OSEA ya hay dni y sesion iniciada muestra la carta
        return view('carta.carta', [
            'productos' => $productos,
            'mesa' => $mesa
        ]);
    }
}
