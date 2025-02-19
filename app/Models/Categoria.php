<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps=false;

    public function get_by_id($id_categoria)
    {
        try {
            return $this->select(['nombre_categoria','id_categoria as codigo'])->where('id_categoria',$id_categoria)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
