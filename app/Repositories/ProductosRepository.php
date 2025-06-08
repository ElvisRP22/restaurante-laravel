<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductosRepository implements IProductosRepository
{
    public function getAll($busqueda)
    {
        //Agregar paginacion en el return
        $builder = Producto::orderBy('nombre');
        if ($busqueda) {
            $builder->where('nombre', 'like', '%' . $busqueda . '%');
        }
        return $builder->paginate(2);
    }

    public function getById($id)
    {
        return Producto::find($id);
    }

    public function create(array $data)
    {
        return Producto::create($data);
    }

    public function update($id, array $data)
    {
        return Producto::find($id)->update($data);
    }

    public function delete($id)
    {
        return Producto::find($id)->delete();
    }
}