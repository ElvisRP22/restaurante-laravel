<?php

namespace App\Repositories;

use App\Models\Empleado;

class EmpleadoRepository implements IEmpleadoRepository
{
    
    public function create(array $data)
    {
        return Empleado::create($data);
    }

    public function findByUsername(string $username)
    {
        return Empleado::where('usuario', $username)->first();
    }

    public function getAll()
    {
        return Empleado::all();
    }

    public function delete(int $id)
    {
        return Empleado::find($id)->delete();
    }
}