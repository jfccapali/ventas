<?php

namespace App\Http\Controllers;

use App\Http\Requests\venta\Venta_registrar_store_request;
use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VentaController extends Controller
{
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
        try {
            dd($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }
    }

}
