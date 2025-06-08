<?php
/*
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
*/



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Laravel por defecto usa 'id' como primaryKey, así que esta línea ya no es necesaria:
    // protected $primaryKey = 'id_producto';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen'
    ];

    // Relaciones: si ya no tienes categorías ni detallePedidos, puedes eliminarlas
    // Si en el futuro agregas, puedes volver a definirlas
}
