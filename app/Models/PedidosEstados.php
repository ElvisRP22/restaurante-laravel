<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedidosEstados extends Model
{
    protected $primaryKey = ['id_pedido_estado', 'id_categoria'];

    protected $fillable = [
        'id_pedido',
        'id_estado',
        'fecha_registro'
    ];

    // un pedido_estado tiene un pedido
    public function pedidos()
    {
        return $this->belongsTo(Pedidos::class, ['id_pedido'],['id_pedido']);
    }

    // un pedido_estado tiene un estado
    public function estados()
    {
        return $this->belongsTo(Estados::class, ['id_estado'], ['id_estado']);
    }
}

