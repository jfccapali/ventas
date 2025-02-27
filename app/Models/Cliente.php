<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps=false;
    protected $table='clientes';
    protected $primaryKey = 'id_cliente';

    public function lista_paginado($page,$url,$per_page,$nombre_completo,$sexo)
    {
        try {
            $query=$this->select(['id_cliente','nombres','apellido_paterno','apellido_materno','sexo','direccion','nombre_imagen','fecha_imagen','fecha_nacimiento','estado'])->orderByRaw("concat(apellido_paterno,' ',apellido_materno,' ',nombres)");

            if($nombre_completo!=null){
                $query->whereRaw("(upper(concat(apellido_paterno,' ',apellido_materno,' ',nombres))) like ? ",[$nombre_completo.'%']);
            }

            if($sexo!=null){
                $query->where('sexo',$sexo);
            }

            return $query->paginate($per_page,'','page',$page)->setPath($url);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
