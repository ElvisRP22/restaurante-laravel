<?php

namespace App\Http\Controllers\categorias;

use Illuminate\Http\Request;
use App\Repositories\ICategoriasRepository;
use App\Http\Controllers\Controller;

class CategoriasController extends Controller
{

    private ICategoriasRepository $repo;

    public function __construct(ICategoriasRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $busqueda = trim($request->get('busqueda'));
        $categorias = $this->repo->getAllWithPagination($busqueda);
        return view('home.categorias.index', compact('categorias', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.categorias.create');
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
        
        $validated =$request->validate([
            'descripcion' => 'required|string|max:255|unique:categorias',
        ]);

        $this->repo->create($validated);
        return redirect()->route('home.categorias.index');
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
        $categoria = $this->repo->getById($id);
        return view('home.categorias.edit', compact('categoria'));
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
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);
        $this->repo->update($id, $request->all());
        return redirect()->route('home.categorias.index');
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
        $this->repo->delete($id);
        return redirect()->route('home.categorias.index');
    }
}
