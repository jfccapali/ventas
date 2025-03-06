<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Servicios\ProductoService;
use App\Http\Requests\producto\Producto_store_request;
use App\Http\Requests\producto\Producto_update_request;

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

            $data=$this->producto_service->listado_paginado($request->nombre_producto,$request->codigo_producto,$request->codigo_categoria,5,$request->page,route('producto.index').'?'.$_SERVER['QUERY_STRING']);

            return view('producto.index',['data'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {
        try {
            $data_categoria=Categoria::select(['nombre_categoria','id_categoria'])->where('estado','1')->get();

            return view('producto.create',['data_categoria'=>$data_categoria]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function store(Producto_store_request $request)
    {
        DB::beginTransaction();
        try {
            $this->producto_service->store($request->nombre_producto,$request->descripcion,$request->categoria,$request->stock,$request->precio,$request->file('imagen'));
            DB::commit();
            return redirect()->route('producto.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('producto.create')->with('error',$th->getMessage());
        }
    }

    public function edit(int $id_producto)
    {
        try {

            $data= $this->producto_service->edit($id_producto);

            return view('producto.edit',$data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function update(int $id_producto,Producto_update_request $request)
    {
        try {
            $this->producto_service->update($id_producto,$request->nombre_producto,$request->descripcion,$request->categoria,$request->stock,$request->precio,$request->estado,$request->file('imagen'));

            return redirect()->route('producto.index')->with('success','Se guardaron los cambios correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('producto.edit',['id_producto'=>$id_producto])->with('error',$th->getMessage());
        }
    }

    public function delete()
    {

    }

    public function list_productos(Request $request)
    {
        try {
            $data=$this->producto_service->list_productos($request->search);

            return $this->producto_service->send_success($data,null);
        } catch (\Throwable $th) {
            return $this->producto_service->send_error([],$th->getMessage(),500);
        }
    }

}
