<?php

namespace App\Http\Controllers;

use App\Repositories\ICategoriasRepository;
use App\Repositories\IProductosRepository;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private IProductosRepository $repo;
    private ICategoriasRepository $repoCategoria;
    public function __construct(IProductosRepository $repo, ICategoriasRepository $repoCategoria)
    {
        $this->repo = $repo;
        $this->repoCategoria = $repoCategoria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->repoCategoria->getAll();
        $productos = $this->repo->getAll();
        return view('home.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->repoCategoria->getAll();
        return view('home.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar todo, incluyendo la imagen como archivo
        $validated = $request->validate([
            'id_categoria' => 'required|numeric',
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:1',
            'imagen' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'required|boolean',
        ]);

        // Procesar imagen
        $imagen = $request->file('imagen');
        $filename = time() . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('storage/imagenes'), $filename);

        // Reemplazar 'imagen' en el array validado
        $validated['imagen'] = $filename;

        // Crear producto con datos ya limpios
        $this->repo->create($validated);

        return redirect()->route('home.productos.index');
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
        $producto = $this->repo->getById($id);
        return view('home.productos.edit', compact('producto'));
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
        $request->validate(
            [
                'id_categoria' => 'required|numeric',
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'imagen' => 'required|string|max:255',
                'estado' => 'required|boolean',
            ]
        );
        $this->repo->update($id, $request->all());
        return redirect()->route('home.productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('home.productos.index');
    }
}
