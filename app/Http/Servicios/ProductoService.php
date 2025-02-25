<?php

namespace App\Http\Servicios;

use App\Http\Servicios\Service;
use App\Models\Categoria;
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

    public function store($nombre_producto,$descripcion,$id_categoria,$stock,$precio,$nombre_imagen)
    {
        try {
            $producto=new Producto();
            $producto->nombre_producto=$nombre_producto;
            $producto->descripcion=$descripcion;
            $producto->id_categoria=$id_categoria;
            $producto->stock=$stock;
            $producto->precio=$precio;
            $producto->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(int $id_producto)
    {
        try {
            $data_producto=Producto::select(['id_producto','nombre_producto','descripcion','id_categoria','stock','precio','nombre_imagen','fecha_imagen','estado'])->where('id_producto',$id_producto)->first();

            if($data_producto==null){
                throw new Exception('Producto no encontrado');
            }

            $data_categoria=Categoria::select(['nombre_categoria','id_categoria'])->where('estado','1')->get();

            return ['data'=>$data_producto,'data_categoria'=>$data_categoria];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(int $id_producto,string $nombre_producto,string|null $descripcion,int $id_categoria,int $stock,float $precio,string $estado, $nombre_imagen)
    {
        try {
            $cantidad_producto=Producto::where('id_producto',$id_producto)->count();

            if($cantidad_producto==0){
                throw new Exception('Producto no encontrado');
            }

            $arreglo=[];
            $arreglo['nombre_producto']=$nombre_producto;
            $arreglo['descripcion']=$descripcion;
            $arreglo['id_categoria']=$id_categoria;
            $arreglo['stock']=$stock;
            $arreglo['precio']=$precio;
            $arreglo['estado']=$estado;

            Producto::where('id_producto',$id_producto)->update($arreglo);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
