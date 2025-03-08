<?php

namespace App\Http\Servicios;

use Exception;
use App\Http\Servicios\Service;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Venta_detalle;

class VentaService extends Service
{
    public function store(array $productos,array $cantidades,int $id_cliente,int $usuario_registro):void
    {
        try {

            if(count($productos)!=count($cantidades)){
                throw new Exception("los productos no corresponde a sus cantidades");
            }

            $data_productos=Producto::select(['id_producto','stock','precio','estado','nombre_producto'])->whereIn('id_producto',$productos)->get();
            $importe_venta=0;

            for ($i=0; $i <$data_productos->count() ; $i++) {
                if(!($data_productos[$i]->stock>=$cantidades[$i] && $data_productos[$i]->estado=='1')){
                    throw new Exception("El producto ".$data_productos[$i]->nombre_producto." solo tiene ".$data_productos[$i]->stock." y esta solicitando ".$cantidades[$i]);
                }

                $importe_venta +=$data_productos[$i]->precio*$cantidades[$i];
            }

            $fecha_actual=now();

            $venta=new Venta();
            $venta->id_cliente=$id_cliente;
            $venta->id_vendedor=$usuario_registro;
            $venta->importe_venta=$importe_venta;
            $venta->estado_transaccion='G';
            $venta->estado='1';
            $venta->usuario_creacion=$usuario_registro;
            $venta->fecha_creacion=$fecha_actual;
            $venta->save();

            $id_venta=$venta->id_venta;

            for ($i=0; $i <$data_productos->count() ; $i++) {
                $venta_detalle=new Venta_detalle();
                $venta_detalle->id_venta=$id_venta;
                $venta_detalle->id_producto=$productos[$i];
                $venta_detalle->cantidad=$cantidades[$i];
                $venta_detalle->precio_venta=$data_productos[$i]->precio;
                $venta_detalle->importe=$data_productos[$i]->precio*$cantidades[$i];
                $venta_detalle->estado='1';
                $venta_detalle->usuario_creacion=$usuario_registro;
                $venta_detalle->fecha_creacion=$fecha_actual;
                $venta_detalle->save();

                $nuevo_stock=$data_productos[$i]->stock - $cantidades[$i];
                Producto::where('id_producto',$productos[$i])->update(['stock'=>$nuevo_stock]);
            }



        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
