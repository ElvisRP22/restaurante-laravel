<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Mesa;
use App\Models\Estado;
use App\Models\Pedido;
use App\Models\Pedidos;
use Illuminate\Http\Request;

use App\Repositories\IPedidosRepositorio;

class PedidosController extends Controller
{
    protected $pedidos;

    public function __construct(IPedidosRepositorio $pedidos)
    {
        $this->pedidos = $pedidos;
    }

    public function index()
    {
        $pedidos = $this->pedidos->obtenerTodos();
        return view('home.pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $mesas = Mesa::all();
        $estados = Estado::all();

        return view('home.pedidos.create', compact('clientes', 'empleados', 'mesas', 'estados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_empleado' => 'required|exists:empleados,id',
            'id_mesa' => 'required|exists:mesas,id',
            'id_estado' => 'required|exists:estados,id',
            'total' => 'required|numeric|min:0',
            'fecha_registro' => 'required|date',
        ]);

        Pedidos::create($validated);

        return redirect()->route('home.pedidos.index')
            ->with('success', 'Pedido creado exitosamente.');
    }

    public function edit($id)
    {
        $pedido = $this->pedidos->obtenerPorId($id);
        dd($pedido->fecha_registro); // Verifica qué contiene este campo
        return view('home.pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|integer|exists:clientes,id_cliente',
            'id_empleado' => 'required|integer|exists:empleados,id_empleado',
            'id_mesa' => 'required|integer|exists:mesas,id_mesa',
            'total' => 'required|numeric|min:0',
            'fecha_registro' => 'required|date',
        ]);

        $this->pedidos->actualizar($id, $validated);

        return redirect()->route('home.pedidos.index')->with('success', 'Pedido actualizado correctamente.');
    }

    public function destroy($id)
    {
        $this->pedidos->eliminar($id);

        return redirect()->route('home.pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    }
}

