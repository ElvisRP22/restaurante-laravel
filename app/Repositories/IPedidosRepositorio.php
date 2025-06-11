<?php

namespace App\Repositories;

interface IPedidosRepositorio
{
    public function obtenerTodos();
    public function obtenerPorId($id);
    public function crear(array $data);
    public function actualizar($id, array $data);
    public function eliminar($id);
}
