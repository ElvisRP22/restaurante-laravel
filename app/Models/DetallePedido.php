<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'precio',
        'subtotal'
    ];

    // un detalle pertenece a un pedido
    public function pedidos()
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido', 'id_pedido');
    }

    //un detalle contiene un producto
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
