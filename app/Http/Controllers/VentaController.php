<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function registrar_venta()
    {
        try {
            $data_cliente=Cliente::select(['id_cliente','nombres','apellido_paterno','apellido_materno'])->where('estado','1')->get();


            return view('venta.registrar_venta',['data_cliente'=>$data_cliente]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
