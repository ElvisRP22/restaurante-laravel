<?php

namespace App\Http\Controllers;
use App\Models\SesionMesa;
use App\Models\Comprobante;
use Illuminate\Http\Request;

class ComprobanteController extends Controller
{
    public function solicitar(Request $request)
    {
        $mesa = $request->input('mesa');
        $sesionId = $request->input('sesion_id');

        // Verifica si ya existe un comprobante para esta sesión (opcional)
        $yaExiste = Comprobante::where('sesion_id', $sesionId)->exists();
        if ($yaExiste) {
            return back()->with('error', 'Ya has solicitado un comprobante.');
        }

        // 2. Crear el comprobante
        Comprobante::create([
            'mesa' => $mesa,
            'sesion_id' => $sesionId,
            'estado' => 'pendiente',
        ]);

        // 3. Actualizar la fecha_fin en sesiones_mesa
        $sesion = SesionMesa::find($sesionId);
        $sesion->fecha_fin = now();
        $sesion->save();

        return back()->with('success', 'Comprobante solicitado con éxito.');
    }
}
