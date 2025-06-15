<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Repositories\IProductosRepository;
use Cart;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    private IProductosRepository $repoProductos;

    public function __construct(IProductosRepository $repoProductos)
    {
        $this->repoProductos = $repoProductos;
    }

    public function index()
    {
        $carrito = session()->get('carrito');
        return view('cart.index', compact('carrito'));
    }

    public function add(Request $request)
    {
        $producto = $this->repoProductos->getById($request->id);
        $cantidad = $request->cantidad;
        if (empty($producto)) {
            return redirect()->back();
        } else {
            Cart::add(
                $producto->id_producto,
                $producto->nombre,
                $producto->precio,
                (int)$cantidad

            );
        }
        return redirect()->back()->with("success", "Producto agregado");
    }

    public function clear()
    {
        Cart::clear();
        return back()->with("success", "Carrito vacio");
    }

    public function removeitem(Request $request)
    {
        //$producto = $this->repoProductos->getById($request->id);
        Cart::remove(
            ['id'=>$request->id,]
        );
        return back()->with("success", "Producto eliminado");
    }
}
