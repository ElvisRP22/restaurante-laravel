<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductosRepository implements IProductosRepository
{
    public function getAll()
    {
        return Producto::with('categoria')->get();
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