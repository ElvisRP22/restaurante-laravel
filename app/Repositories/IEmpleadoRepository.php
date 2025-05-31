<?php

namespace App\Repositories;

interface IEmpleadoRepository
{
    public function create(array $data);
    public function findByUsername(string $username);
}