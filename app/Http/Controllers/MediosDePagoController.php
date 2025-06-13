<?php

namespace App\Http\Controllers;

use App\Repositories\IMediosDePagoRepository;
use Illuminate\Http\Request;

class MediosDePagoController extends Controller
{

    private IMediosDePagoRepository $mediosDePagoRepository;

    public function __construct(IMediosDePagoRepository $mediosDePagoRepository)
    {
        $this->mediosDePagoRepository = $mediosDePagoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medios = $this->mediosDePagoRepository->getAll();
        return view('home.medios.index', compact('medios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate(
            ['descripcion' => 'required|string|unique:medios_de_pago']
        );
        $this->mediosDePagoRepository->create($validate);
        return redirect()->route('home.medios-de-pago.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validate = $request->validate(
            ['descripcion' => 'required|string|unique:medios_de_pago,descripcion']
        );
        $medio = $this->mediosDePagoRepository->getById($id);
        if ($medio->descripcion != $validate['descripcion']) {
            $this->mediosDePagoRepository->update($id, $validate);
        }

        return redirect()->route('home.medios-de-pago.index')->with('success', 'Medio de pago actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->mediosDePagoRepository->delete($id);
        return redirect()->route('home.medios-de-pago.index')->with('success', 'Medio de pago actualizado correctamente.');
    }
}
