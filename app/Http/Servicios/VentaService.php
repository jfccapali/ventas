<?php

namespace App\Http\Servicios;

use Exception;
use App\Http\Servicios\Service;
use App\Models\Producto;

class VentaService extends Service
{
    public function store(array $productos,array $cantidades,int $id_cliente,int $usuario_registro):void
    {
        try {

            for ($i=0; $i <count($productos) ; $i++) {
                $data=Producto::where('cantidad','<',$cantidades[$i])->where('id_producto',$productos[$i])->first();
            }


        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
