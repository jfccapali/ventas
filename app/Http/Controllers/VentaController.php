<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Servicios\VentaService;
use App\Http\Requests\venta\Venta_registrar_store_request;

class VentaController extends Controller
{
    private VentaService $venta_service;

    public function __construct(VentaService $venta_service)
    {
        $this->venta_service=$venta_service;
    }


    public function registrar_venta()
    {
        try {

            return view('venta.registrar_venta');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function registrar_venta_store(Venta_registrar_store_request $request)
    {
        DB::beginTransaction();
        try {
            //dd($request->all());
            $usuario_registro=Auth::user()->id_usuario;

            $this->venta_service->store($request->producto_codigo,$request->producto_cantidad,$request->cliente,$usuario_registro);
            DB::commit();
            return $this->venta_service->send_success([],"se grabo correctamente la venta");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->venta_service->send_error([],$th->getMessage(),500);
        }
    }

}
