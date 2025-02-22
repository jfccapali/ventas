<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoria\Categoria_index_request;
use App\Http\Requests\categoria\Categoria_store_request;
use App\Http\Servicios\categoria\CategoriaService;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    private CategoriaService $categoria_service;

    public function __construct(CategoriaService $categoria_service)
    {
        $this->categoria_service=$categoria_service;
    }

    public function index()
    {
        try {

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

    public function store(Categoria_store_request $request)
    {
        try {
            $this->categoria_service->store($request->nombre_categoria,$request->descripcion);

            return redirect()->route('categoria.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('categoria.create')->with('error',$th->getMessage());
        }
    }

    public function edit(int $id_categoria)
    {
        try {
            $data=Categoria::select(['id_categoria','nombre_categoria','descripcion','estado'])->where('id_categoria',$id_categoria)->first();

            if($data==null){
                throw new Exception('Registro no encontrado');
            }

            return view('categoria.edit',['data'=>$data]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
