<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoriasRepository implements ICategoriasRepository
{
    public function getAll()
    {
        return Categoria::all();
    }

    public function getById($id)
    {
        return Categoria::find($id);
    }

    public function create(array $data)
    {
        return Categoria::create($data);
    }

    public function update($id, array $data)
    {
        return Categoria::find($id)->update($data);
    }

    public function delete($id)
    {
        return Categoria::find($id)->delete();
    }
}