<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediosDePago extends Model
{
    use HasFactory;
    protected $table = 'medios_de_pago';
    protected $primaryKey = 'id_medio_pago';

    protected $fillable = [
        'descripcion'
    ];
    
    //un medio de pago puese usarse por mucho pagos
    public function pagos()
    {
        return $this->hasMany(Pagos::class, 'id_medio_pago', 'id_medio_pago');
    }
}
