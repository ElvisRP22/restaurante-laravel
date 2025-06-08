<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        DB::table('pedidos')->insert([
            'mesa' => session('mesa'),
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'estado' => 'pendiente',
            'fecha' => now(),
            'sesion_id' => session('sesion_id')
        ]);

        return redirect()->back()->with('success', 'Pedido registrado correctamente');
    }

    /*--------------VIsor-------------------*/


public function visor(){

    $pedidos = Pedido::with('producto')
        ->where('estado', 'pendiente')
        ->orderBy('fecha', 'asc')
        ->get();

        return view('visor.visor', compact('pedidos'));
}

public function marcarListo($id)
{
    $pedido = Pedido::findOrFail($id);
    $pedido->estado = 'listo';
    $pedido->save();

    return back()->with('success', 'Pedido marcado como listo');
}
}

