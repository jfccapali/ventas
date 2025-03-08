<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function reporte_ventas(Request $request)
    {
        try {
            $venta=new Venta();
            $data=$venta->reporte_ventas($request->cliente,$request->producto,$request->codigo_venta);

            $pdf = Pdf::loadView('pdf.reporte_ventas', ['data'=>$data])->setPaper('A4');

            return $pdf->stream();
            //return $pdf->download('reporte de ventas.pdf');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
