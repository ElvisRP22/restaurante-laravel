<?php

namespace App\Repositories;

use App\Models\MediosDePago;

class MediosDePagoRepository implements IMediosDePagoRepository{
    public function getAll()
    {
        //
        return MediosDePago::all();
    }

    public function getById($id)
    {
        //
        return MediosDePago::find($id);
    }

    public function create(array $data)
    {
        //
        return MediosDePago::create($data);
    }

    public function update($id, array $data)
    {
        //
        return MediosDePago::find($id)->update($data);
    }

    public function delete($id)
    {
        //
        return MediosDePago::find($id)->delete();
    }
}