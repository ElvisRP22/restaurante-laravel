<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

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










    
public function agregarAlCarrito(Request $request)
{
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
    ]);

    $productoId = $request->producto_id;
    $cantidad = $request->cantidad;

    // Obtener el carrito actual de sesión o iniciar uno vacío
    $carrito = Session::get('carrito', []);

    // Si ya existe el producto en el carrito, sumamos cantidad
    if (isset($carrito[$productoId])) {
        $carrito[$productoId]['cantidad'] += $cantidad;
    } else {
        // Traemos los datos del producto para mostrar en el carrito
        $producto = \App\Models\Producto::find($productoId);
        $carrito[$productoId] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => $cantidad
        ];
    }

    // Guardamos el carrito actualizado en sesión
    Session::put('carrito', $carrito);

    return back()->with('success', 'Producto agregado al carrito.');
}

public function confirmarCarrito()
{
    $carrito = Session::get('carrito', []);
    $cliente_id = session('cliente_id');
    $mesa = session('mesa');
    $sesion_id = session('sesion_id');

    if (empty($carrito) || !$cliente_id || !$mesa || !$sesion_id) {
        return redirect()->back()->with('error', 'Carrito vacío o sesión no válida.');
    }

    foreach ($carrito as $productoId => $item) {
        DB::table('pedidos')->insert([
            'mesa' => $mesa,
            'producto_id' => $productoId,
            'cantidad' => $item['cantidad'],
            'estado' => 'pendiente',
            'sesion_id' => $sesion_id,
            'fecha' => now()
        ]);
    }

    Session::forget('carrito');

    return redirect()->back()->with('success', '¡Pedido enviado a cocina!');
}



}
