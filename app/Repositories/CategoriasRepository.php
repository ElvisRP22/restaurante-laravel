<?php

namespace App\Repositories;

use App\Models\Categorias;

class CategoriasRepository implements ICategoriasRepository
{
    public function getAll()
    {
        return Categorias::all();
    }

    public function getById($id)
    {
        return Categorias::find($id);
    }

    public function create(array $data)
    {
        return Categorias::create($data);
    }

    public function update($id, array $data)
    {
        return Categorias::find($id)->update($data);
    }

    public function delete($id)
    {
        return Categorias::find($id)->delete();
    }
}