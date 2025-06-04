<?php

namespace App\Repositories;

use App\Models\Mesa;

class MesaRepository implements IMesaRepository{
    public function getAll()
    {
        //
        return Mesa::all();
    }

    public function getById($id)
    {
        //
        return Mesa::find($id);
    }

    public function create(array $data)
    {
        //
        return Mesa::create($data);
    }

    public function update($id, array $data)
    {
        //
        return Mesa::find($id)->update($data);
    }

    public function delete($id)
    {
        //
        return Mesa::find($id)->delete();
    }
}