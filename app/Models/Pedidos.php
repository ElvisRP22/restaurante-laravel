<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_cliente',
        'id_empleado',
        'id_mesa',
        'total',
        'fecha_registro'
    ];

    // un pedido tiene un cliente
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente', 'id_cliente');
    }

    // un pedido tiene un empleado
    public function empleados()
    {
        return $this->belongsTo(Empleados::class, 'id_empleado', 'id_empleado');
    }

    public function pedidoEstado()
    {
        return $this->hasMany(PedidosEstados::class, ['id_estado', 'id_categoria'], ['id_estado', 'id_categoria']);
    }

    // un pedido tiene muchos pagos
    public function pagos()
    {
        return $this->hasMany(Pagos::class, 'id_pedido', 'id_pedido');
    }


    //un pedido tiene una mesa
    public function mesa()
    {
        return $this->belongsTo(Mesas::class, 'id_mesa', 'id_mesa');
    }

    // un pedido tiene muchos detalles
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }
}
