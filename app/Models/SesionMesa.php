<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionMesa extends Model
{
    use HasFactory;

    protected $primaryKey = 'session_id';

    public $timestamps = false;

    protected $fillable = [
        'mesa',
        'cliente_id',
        'fecha_inicio',
        'fecha_fin'
    ];


}
