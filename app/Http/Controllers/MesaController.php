<?php

namespace App\Http\Controllers;

use App\Repositories\IMesaRepository;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    private IMesaRepository $mesaRepository;
    
    public function __construct(IMesaRepository $mesaRepository)
    {
        $this->mesaRepository = $mesaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mesas = $this->mesaRepository->getAll();
        return view('home.mesas.index', compact('mesas'));
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
        $validated = $request->validate(
            ['numero_mesa' => 'required|numeric|unique:mesas,numero_mesa',
            'capacidad' => 'required|numeric']
        );
        $validated['estado'] = true;
        $this->mesaRepository->create($validated);
        return redirect()->route('home.mesas.index');
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
        $validated = $request->validate(
            [
            'numero_mesa' => 'required|numeric',
            'capacidad' => 'required|numeric']
        );
        $validated['estado'] = true;
        $this->mesaRepository->update($id, $validated);
        return redirect()->route('home.mesas.index');

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
        $this->mesaRepository->delete($id);
        return redirect()->route('home.mesas.index');
    }
}
