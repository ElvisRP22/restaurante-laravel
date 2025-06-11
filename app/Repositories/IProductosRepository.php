<?php

namespace App\Repositories;

interface IProductosRepository
{
    public function getAll($busqueda);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}