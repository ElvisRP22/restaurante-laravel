<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comprobante;

class ComprobantesVisorController extends Controller
{
    public function store(Request $request)
    {
        DB::table('comprobantes')->insert([
            'mesa' => session('mesa'),
            'estado' => 'pendiente',
            'fecha' => now(),
            'sesion_id' => session('sesion_id')
        ]);

        return redirect()->back()->with('success', 'Comproabante registrado correctamente');
    }

    /*--------------VIsor-------------------*/


    public function visor(){

        $comprobantes = Comprobante::with('comprobante')
            ->where('estado', 'pendiente')
            ->orderBy('fecha', 'asc')
            ->get();

            return view('visor.visor_comprobante', compact('comprobantes'));
    }

    public function marcarListo($id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->estado = 'listo';
        $comprobante->save();

        return back()->with('success', 'Pedido marcado como listo');
    }
}
