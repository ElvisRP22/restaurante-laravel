<?php

namespace App\Repositories;

use App\Models\Empleados;

class EmpleadosRepository implements IEmpleadosRepository
{
    
    public function create(array $data)
    {
        return Empleados::create($data);
    }

    public function findByUsername(string $username)
    {
        return Empleados::where('usuario', $username)->first();
    }
}