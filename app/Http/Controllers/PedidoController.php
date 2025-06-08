<?php

namespace App\Http\Controllers;

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
}

