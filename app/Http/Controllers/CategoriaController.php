<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoria\Categoria_index_request;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        try {

            ;
            //dd($request->all());

            $categoria=new Categoria();
            $data=$categoria->paginate(10);

            return view('categoria.index',['data_categoria'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {
        try {
            return view('categoria.create');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $categoria=new Categoria();
            $categoria->nombre_categoria=$request->nombre_categoria;
            $categoria->descripcion=$request->descripcion;
            $categoria->estado='1';
            $categoria->save();


        } catch (\Throwable $th) {
            dd($th);
        }
    }


}
