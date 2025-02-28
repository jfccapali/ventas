<?php

namespace App\Http\Servicios;

use Exception;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use App\Http\Servicios\Service;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductoService extends Service
{
    public function listado_paginado($nombre_producto,$id_producto,$id_categoria,$per_page,$page,$url)
    {
        try {
            $producto=new Producto();

            return $producto->lista_paginada($nombre_producto,$id_producto,$id_categoria,$per_page,$page,$url);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store($nombre_producto,$descripcion,$id_categoria,$stock,$precio, $nombre_imagen)
    {
        try {
            $producto=new Producto();
            $producto->nombre_producto=$nombre_producto;
            $producto->descripcion=$descripcion;
            $producto->id_categoria=$id_categoria;
            $producto->stock=$stock;
            $producto->precio=$precio;
            $producto->save();

            if($nombre_imagen!=null){
                $id_producto=$producto->id_producto;
                $extension=$nombre_imagen->getClientOriginalExtension();
                $nombre_archivo= (string)Str::orderedUuid().'.'.$extension;

                $accion=Storage::disk('public')->put('/producto/'.$nombre_archivo,\File::get($nombre_imagen));


                if(!$accion){
                    throw new Exception("Error al guardar el archivo");
                }

                $arreglo=[];
                $arreglo['nombre_imagen']=$nombre_archivo;
                $arreglo['fecha_imagen']=now();
                $producto->where('id_producto',$id_producto)->update($arreglo);
            }

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

    public function update(int $id_producto,string $nombre_producto,string|null $descripcion,int $id_categoria,int $stock,float $precio,string $estado, $imagen)
    {
        try {
            $datab=Producto::select(['nombre_imagen'])->where('id_producto',$id_producto)->first();

            if($datab==null){
                throw new Exception('Producto no encontrado');
            }

            $arreglo=[];
            if($imagen!=null){

                $extension=$imagen->getClientOriginalExtension();
                $nombre_archivo= (string)Str::orderedUuid().'.'.$extension;

                $accion=Storage::disk('public')->put('/producto/'.$nombre_archivo,\File::get($imagen));

                if(!$accion){
                    throw new Exception("Error al guardar el archivo");
                }

                if($datab->nombre_imagen){
                    Storage::disk('public')->delete('/producto/'.$datab->nombre_imagen);
                }

                $arreglo['nombre_imagen']=$nombre_archivo;
                $arreglo['fecha_imagen']=now();
            }


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
