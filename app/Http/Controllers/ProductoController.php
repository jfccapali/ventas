<?php

namespace App\Http\Controllers;

use App\Http\Servicios\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    private ProductoService $producto_service;

    public function __construct(ProductoService $producto_service)
    {
        $this->producto_service=$producto_service;
    }

    public function index(Request $request)
    {
        try {

            $data=$this->producto_service->listado_paginado($request->nombre_producto,$request->codigo_producto,$request->codigo_categoria,$request->per_page,$request->page);

            return view('producto.index',['data'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}
