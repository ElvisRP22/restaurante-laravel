<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductosRepository implements IProductosRepository
{
    public function getAll($busqueda, $rows)
    {

        $builder = Producto::orderBy('nombre');
        if ($busqueda) {
            $builder->where('nombre', 'like', '%' . $busqueda . '%' );
        }
        return $builder->paginate($rows)->appends([
            'busqueda' => $busqueda,
            'rows' => $rows
        ]);
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
