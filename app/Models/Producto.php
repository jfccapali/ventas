<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps=false;
    protected $table='productos';
    protected $primaryKey = 'id_producto';

    public function lista_paginada($nombre_producto,$id_producto,$id_categoria,$per_page,$page,$url)
    {
        try {
            $query=$this->from('productos','t1')
                ->join('categorias as t2','t1.id_categoria','=','t2.id_categoria')
                ->select(['t1.id_producto','t1.nombre_producto','t2.nombre_categoria','t1.descripcion','t1.estado','t1.nombre_imagen','t1.fecha_imagen','t1.precio','t1.stock']);

            if($nombre_producto!=null){
                $query->where('t1.nombre_producto','like','%'.$nombre_producto.'%');
            }

            if($id_producto!=null){
                $query->where('t1.id_producto',$id_producto);
            }

            if($id_categoria!=null){
                $query->where('t1.id_categoria',$id_categoria);
            }

            return $query->paginate($per_page,'','page',$page)->setPath($url);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
