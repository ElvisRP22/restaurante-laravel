<?php

namespace App\Repositories;

use App\Models\Pedido;
use App\Models\Pedidos;

class PedidosRepositorio implements IPedidosRepositorio
{
    protected $model;

    public function __construct(Pedidos $pedido)
    {
        $this->model = $pedido;
    }

    public function obtenerTodos()
    {
        return $this->model->with(['cliente', 'empleado', 'mesa'])->get();
    }

    public function obtenerPorId($id)
    {
        return $this->model->with(['cliente', 'empleado', 'mesa', 'detallePedidos'])->findOrFail($id);
    }

    public function crear(array $data)
    {
        // Suponemos $data contiene campos compatibles con $fillable
        return $this->model->create($data);
    }

    public function actualizar($id, array $data)
    {
        $pedido = $this->model->findOrFail($id);
        $pedido->update($data);
        return $pedido;
    }

    public function eliminar($id)
    {
        $pedido = $this->model->findOrFail($id);
        return $pedido->delete();
    }
}

