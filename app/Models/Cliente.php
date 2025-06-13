<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'dni',
        'nombre',
        'telefono'
    ];
    // un cliente tiene muchos pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_cliente', 'id_cliente');
    }
}
