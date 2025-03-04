<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{
    public $timestamps=false;
    protected $table='venta_detalles';
    protected $primaryKey = 'id_venta_detalle';
}
