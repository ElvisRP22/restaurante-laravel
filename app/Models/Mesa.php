<?php
/*
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class Mesas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_mesa';

    protected $fillable = [
        'numero_mesa',
        'capacidad',
        'estado'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_mesa', 'id_mesa');
    }
}

*/
