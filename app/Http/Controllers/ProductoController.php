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
    public function index(Request $request)
    {
        $busqueda = trim($request->get('busqueda'));
        $categorias = $this->repoCategoria->getAll();
        $productos = $this->repo->getAll($busqueda);
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
        $validated = $request->validate([
            'id_categoria' => 'required|numeric',
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:1',
            'imagen' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'required|boolean',
        ]);

        $imagen = $request->file('imagen');
        $filename = time() . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('storage/imagenes'), $filename);
        $validated['imagen'] = $filename;
        $this->repo->create($validated);

        return redirect()->route('home.productos.index')->with('success', 'Producto creado correctamente.');
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
        $categorias = $this->repoCategoria->getAll();
        $producto = $this->repo->getById($id);
        return view('home.productos.edit', compact('producto', 'categorias'));
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
        $validated = $request->validate([
            'id_categoria' => 'required|numeric',
            'nombre' => 'required|string|max:255|unique:productos,nombre,' . $id . ',id_producto',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:1',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'required|boolean',
        ]);
        $producto = $this->repo->getById($id);
        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path('storage/imagenes/' . $producto->imagen))) {
                unlink(public_path('storage/imagenes/' . $producto->imagen));
            }
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/imagenes', $filename);
            $validated['imagen'] = $filename;
        } else {
            $validated['imagen'] = $producto->imagen;
        }
        $this->repo->update($id, $validated);
        return redirect()->route('home.productos.index')->with('success', 'Producto actualizado correctamente.');
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
        return redirect()->route('home.productos.index')->with("success", "Producto eliminado correctamente");
    }
}
