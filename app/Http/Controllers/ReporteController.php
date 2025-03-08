<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function reporte_ventas(Request $request)
    {
        try {
            $data_cliente=Cliente::select(['id_cliente','nombres','apellido_paterno','apellido_materno'])->where('estado','1')
            ->orderBy('apellido_paterno','asc')
            ->orderBy('apellido_materno','asc')
            ->orderBy('nombres','asc')
            ->get();

            $data_producto=Producto::select(['id_producto','nombre_producto'])->where('estado','1')->orderBy('nombre_producto','asc')->get();

            $venta=new Venta();
            $data_reporte=$venta->reporte_ventas($request->cliente,$request->producto,$request->codigo_venta);

            return view('reporte.reporte_ventas',['data_cliente'=>$data_cliente,'data_producto'=>$data_producto,'data_reporte'=>$data_reporte]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
