<?php

namespace App\Repositories;

interface IEmpleadosRepository
{
    public function create(array $data);
    public function findByUsername(string $username);
}