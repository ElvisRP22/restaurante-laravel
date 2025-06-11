<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoriasRepository implements ICategoriasRepository
{
    public function getAllWithPagination($busqueda)
    {
        //Agregar paginacion en el return
        $builder = Categoria::orderBy('descripcion');
        if ($busqueda) {
            $builder->where('descripcion', 'like', '%' . $busqueda . '%');
        }
        return $builder->paginate(2);
    }
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
