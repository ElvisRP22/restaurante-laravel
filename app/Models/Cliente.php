<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cliente'; // si tu clave primaria se llama así
    protected $fillable = ['nombre', 'mesa', 'pedido', 'estado', 'total'];
}
