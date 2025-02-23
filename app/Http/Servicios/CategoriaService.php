<?php

namespace App\Http\Servicios;

use App\Http\Servicios\Service;
use App\Models\Categoria;
use Exception;

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

    public function update($nombre_categoria,$descripcion,$estado,$id_categoria,$usuario_registro)
    {
        try {
            $categoria=new Categoria();

            $datab=$categoria->where('id_categoria',$id_categoria)->count();

            if($datab==0){
                throw new Exception('El registro no existe');
            }

            $arreglo=[];
            $arreglo['nombre_categoria']=$nombre_categoria;
            $arreglo['descripcion']=$descripcion;
            $arreglo['estado']=$estado;

            $categoria->where('id_categoria',$id_categoria)->update($arreglo);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id_categoria,$usuario_registro)
    {
        try {
            $categoria=new Categoria();

            $datab=$categoria->where('id_categoria',$id_categoria)->count();

            if($datab==0){
                throw new Exception('El registro no existe');
            }

            $categoria->where('id_categoria',$id_categoria)->update(['estado'=>'0']);
            //$categoria->where('id_categoria',$id_categoria)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
