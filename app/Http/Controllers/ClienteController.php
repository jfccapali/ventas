<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Servicios\ClienteService;
use App\Http\Requests\cliente\Cliente_index_request;
use App\Http\Requests\cliente\Cliente_store_request;
use App\Http\Requests\cliente\Cliente_update_request;

class ClienteController extends Controller
{
    private ClienteService $cliente_service;

    public function __construct(ClienteService $cliente_service)
    {
        $this->cliente_service=$cliente_service;
    }

    public function index(Cliente_index_request $request)
    {
        try {
            $per_page=$request->per_page??'1';
            $page=$request->page??'1';

            $arreglo=[];
            $arreglo['nombre_completo']=$request->nombre_completo;
            $arreglo['sexo']=$request->sexo;

            //$url=route('cliente.index').'?nombre_completo='.$request->nombre_completo.'&sexo='.$request->sexo;
            $url=route('cliente.index').'?'.http_build_query($arreglo);

            $data=$this->cliente_service->listado_paginado($page,$url,$per_page,$request->nombre_completo,$request->sexo);

            return view('cliente.index',['data'=>$data,'persistencia'=>$arreglo]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {
        try {

            return view('cliente.create');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function store(Cliente_store_request $request)
    {
        DB::beginTransaction();
        try {
            $this->cliente_service->store($request->nombres,$request->apellido_paterno,$request->apellido_materno,$request->direccion,$request->sexo,$request->fecha_nacimiento,$request->file('foto'));
            DB::commit();
            return redirect()->route('cliente.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('cliente.create')->with('error',$th->getMessage());
        }
    }

    public function edit(int $id_cliente)
    {
        try {
            $data=$this->cliente_service->edit($id_cliente);

            return view('cliente.edit',['data'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function update(int $id_cliente,Cliente_update_request $request)
    {
        try {
            $this->cliente_service->update($id_cliente,$request->nombres,$request->apellido_paterno,$request->apellido_materno,$request->direccion,$request->sexo,$request->fecha_nacimiento,$request->estado,$request->file('foto'));
            return redirect()->route('cliente.index')->with('success','Se guardaron los cambios correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('cliente.edit',['id_cliente'=>$id_cliente])->with('error',$th->getMessage());
        }
    }

    public function delete(int $id_cliente)
    {
        try {
            $this->cliente_service->delete($id_cliente);
            return redirect()->route('cliente.index')->with('success','Se elimino correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('cliente.index')->with('error',$th->getMessage());
        }
    }

}
