<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'estado'
    ];

    // un producto tiene una categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    // un producto puede estar en muchos detalles de pedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'id_producto', 'id_producto');
    }
}
