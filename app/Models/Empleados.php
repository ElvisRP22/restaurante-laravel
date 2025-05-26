<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar a esta clase
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Empleados extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'dni',
        'nombre',
        'rol',
        'usuario',
        'clave',
        'fecha_ingreso'
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    // Si quieres usar password hashing automático y nombre de columna estándar:
    // Indica que 'clave' es el campo de password
    public function getAuthPassword()
    {
        return $this->clave;
    }

    // Un empleado atiende a muchos pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_cliente', 'id_cliente');
    }
}
