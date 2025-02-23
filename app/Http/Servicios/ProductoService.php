<?php

namespace App\Http\Servicios;

use App\Http\Servicios\Service;
use App\Models\Producto;
use Exception;

class ProductoService extends Service
{
    public function listado_paginado($nombre_producto,$id_producto,$id_categoria,$per_page,$page)
    {
        try {
            $producto=new Producto();

            return $producto->lista_paginada($nombre_producto,$id_producto,$id_categoria,$per_page,$page);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
