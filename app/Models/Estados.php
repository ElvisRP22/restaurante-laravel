<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Estados extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'descripcion'
    ];

    public function pedidosEstados()
    {
        return $this->hasMany(PedidosEstados::class, ['id_estado', 'id_categoria'], ['id_estado', 'id_categoria']);
    }
}
