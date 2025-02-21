<?php

namespace App\Http\Servicios\categoria;

use App\Http\Servicios\Service;
use App\Models\Categoria;

class CategoriaService extends Service
{
    public function store($nombre_categoria,$descripcion)
    {
        try {
            $categoria=new Categoria();
            $categoria->nombre_categoria=$nombre_categoria;
            $categoria->descripcion=$descripcion;
            $categoria->estado='1';
            $categoria->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
