<?php
/*
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

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class, "pedidos_estados", "id_estado", "id_pedido");
    }
}
*/