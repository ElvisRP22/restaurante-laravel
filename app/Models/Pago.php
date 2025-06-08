<?php
/*
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'descripcion',
        'monto',
        'id_pedido',
        'id_medio_pago'
    ];

    //un pago pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }

    //un pago tiene un medio de pago
    public function medioDePago()
    {
        return $this->belongsTo(MediosDePago::class, 'id_medio_pago', 'id_medio_pago');
    }
}
*/