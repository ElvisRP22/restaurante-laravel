<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create() {
        return view('create.blade.php');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'mesa' => 'required',
            'pedido' => 'required',
            'estado' => 'required|boolean',
            'total' => 'required|numeric'
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function edit($id) {
        $cliente = Cliente::findOrFail($id);
        return view('edit.blade.php', compact('cliente'));
    }

    public function update(Request $request, $id) {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'mesa' => 'required',
            'pedido' => 'required',
            'estado' => 'required|boolean',
            'total' => 'required|numeric'
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($id) {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}

