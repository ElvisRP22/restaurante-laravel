<?php

namespace App\Repositories;

interface ICategoriasRepository
{
    public function getAllWithPagination($busqueda);
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
