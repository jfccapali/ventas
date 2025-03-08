<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps=false;
    protected $table='ventas';
    protected $primaryKey = 'id_venta';

    public function reporte_ventas($id_cliente,$id_producto,$id_venta)
    {
        try {

            $query="
                select
                    t1.id_venta,
                    t1.fecha_creacion,
                    concat(t2.apellido_paterno,' ',t2.apellido_materno,', ',t2.nombres) as nombre_cliente,
                    concat(t3.apellido_paterno,' ',t3.apellido_materno,', ',t3.nombres) as nombre_vendedor,
                    t1.importe_venta,
                    t1.estado_transaccion
                from
                    ventas t1
                    inner join clientes t2 on t1.id_cliente=t2.id_cliente
                    inner join usuarios t3 on t1.id_vendedor=t3.id_usuario
                where
                    1=1

            ";

            $arreglo=[];

            if($id_cliente!=null)
            {
                $query.=" and t1.id_cliente=:id_cliente";
                $arreglo['id_cliente']=$id_cliente;
            }

            if($id_venta!=null)
            {
                $query.=" and t1.id_venta=:id_venta";
                $arreglo['id_venta']=$id_venta;
            }

            if($id_producto!=null)
            {
                $query.=" and t1.id_venta in (select id_venta from venta_detalles where id_producto=:id_producto and estado='1')";
                $arreglo['id_producto']=$id_producto;
            }

            return DB::select($query,$arreglo);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
