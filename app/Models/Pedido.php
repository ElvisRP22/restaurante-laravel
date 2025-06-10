<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Clave primaria personalizada
    protected $primaryKey = 'id_pedido';

    // Asignación masiva permitida
    protected $fillable = [
        'id_cliente',
        'id_empleado',
        'id_mesa',
        'id_estado',
        'total'
        ,
    ];
    protected $casts = [
    'fecha_registro' => 'datetime',
];

    /**
     * Relación: Pedido pertenece a un Cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    /**
     * Relación: Pedido pertenece a un Empleado
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }

    /**
     * Relación: Pedido tiene muchos estados (muchos a muchos)
     */
    public function estados()
    {
        return $this->belongsToMany(Estado::class, 'pedidos_estados', 'id_pedido', 'id_estado')
                    ->withTimestamps();
    }

    /**
     * Relación: Pedido tiene muchos Pagos
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_pedido', 'id_pedido');
    }

    /**
     * Relación: Pedido pertenece a una Mesa
     */
    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa', 'id_mesa');
    }

    /**
     * Relación: Pedido tiene muchos detalles de pedido
     */
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }
}
