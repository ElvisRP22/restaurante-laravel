<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    //Request $request jala de ese contendor
    public function iniciarSesionCliente(Request $request, $mesa)
    {
    
    //del contendor jala la variable dni 
    $request->validate([
        //el campo tiene dos requerimientos 
        //DEBE ESTAR LLENO
        //DEBE TENER 8 DIGITODS
        'dni' => 'required|digits:8'
    ]);


    // Insertar cliente si no existe

    //de la tabla clientes Actualizas o Insertaras
    DB::table('clientes')->updateOrInsert(
        ['dni' => $request->dni],
        ['dni' => $request->dni]
    );

    //    de la tabla clientes donde la columna dni sea igual al dni registrado
    $cliente = DB::table('clientes')->where('dni', $request->dni)->first();

    // Cerrar sesiones anteriores en la mesa
    DB::table('sesiones_mesa')
        ->where('mesa', $mesa)
        ->whereNull('fecha_fin')
        ->update(['fecha_fin' => now()]);

    // Crear nueva sesión
    // de la tabla sesiones INSERTAS Y OBTIENES EL ID
    $sesionId = DB::table('sesiones_mesa')->insertGetId([
        'mesa' => $mesa,
        'cliente_id' => $cliente->id,
        'fecha_inicio' => now()
    ]);

    // Guardar en sesión
    session([
        'cliente_id' => $cliente->id,
        'sesion_id' => $sesionId,
        'mesa' => $mesa
    ]);
    
    return redirect("/mesa/$mesa");
}

}
