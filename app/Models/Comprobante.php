<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'mesa', 
        'sesion_id', 
        'fecha',
        'estado'
    ];


}