<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps=false;
    protected $table='ventas';
    protected $primaryKey = 'id_venta';
}
