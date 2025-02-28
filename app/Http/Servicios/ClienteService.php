<?php

namespace App\Http\Servicios;

use Exception;
use App\Models\Cliente;
use Illuminate\Support\Str;
use App\Http\Servicios\Service;
use Storage;

class ClienteService extends Service
{
    public function listado_paginado($page,$url,$per_page,$nombre_completo,$sexo)
    {
        try {
            $cliente=new Cliente();

            return $cliente->lista_paginado($page,$url,$per_page,$nombre_completo,$sexo);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store($nombres,$apellido_paterno,$apellido_materno,$direccion,$sexo,$fecha_nacimiento,$foto)
    {
        try {
            $cliente=new Cliente();
            $cliente->nombres=$nombres;
            $cliente->apellido_paterno=$apellido_paterno;
            $cliente->apellido_materno=$apellido_materno;
            $cliente->direccion=$direccion;
            $cliente->sexo=$sexo;
            $cliente->fecha_nacimiento=$fecha_nacimiento;
            $cliente->estado='1';
            $cliente->save();

            if($foto!=null){
                $id_cliente=$cliente->id_cliente;

                $extesion=$foto->getClientOriginalExtension();
                $nombre=(string)Str::orderedUuid().'.'.$extesion;
                $ruta='/cliente/'.$nombre;

                if(!Storage::disk('public')->put($ruta,\File::get($foto))){
                    throw new Exception('La foto no se pudo guardar');
                }

                $arreglo=[];
                $arreglo['nombre_imagen']=$nombre;
                $arreglo['fecha_imagen']=now();

                $cliente->where('id_cliente',$id_cliente)->update($arreglo);
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(int $id_cliente)
    {
        try {
            $cliente=new Cliente();

            $data=$cliente->select(['id_cliente','nombres','apellido_paterno','apellido_materno','sexo','direccion','fecha_nacimiento','estado','nombre_imagen','fecha_imagen'])->where('id_cliente',$id_cliente)->first();

            if($data==null){
                throw new Exception('Registro no encontrado');
            }

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(int $id_cliente,$nombres,$apellido_paterno,$apellido_materno,$direccion,$sexo,$fecha_nacimiento,$estado,$foto)
    {
        try {

            $cliente=new Cliente();

            $datab=$cliente->select(['nombre_imagen'])->where('id_cliente',$id_cliente)->first();

            if($datab==null){
                throw new Exception('Registro no encontrado');
            }

            $arreglo=[];
            if($foto!=null){
                $extesion=$foto->getClientOriginalExtension();
                $nombre=(string)Str::orderedUuid().'.'.$extesion;
                $ruta='/cliente/'.$nombre;

                if(!Storage::disk('public')->put($ruta,\File::get($foto))){
                    throw new Exception('La foto no se pudo guardar');
                }
                if($datab->nombre_imagen){
                    Storage::disk('public')->delete('/cliente/'.$datab->nombre_imagen);
                }

                $arreglo['nombre_imagen']=$nombre;
                $arreglo['fecha_imagen']=now();
            }


            $arreglo['nombres']=$nombres;
            $arreglo['apellido_paterno']=$apellido_paterno;
            $arreglo['apellido_materno']=$apellido_materno;
            $arreglo['direccion']=$direccion;
            $arreglo['sexo']=$sexo;
            $arreglo['fecha_nacimiento']=$fecha_nacimiento;
            $arreglo['estado']=$estado;

            $cliente->where('id_cliente',$id_cliente)->update($arreglo);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(int $id_cliente)
    {
        try {

            $cliente=new Cliente();

            $cantidad_registros=$cliente->where('id_cliente',$id_cliente)->count();

            if($cantidad_registros==0){
                throw new Exception('Registro no encontrado');
            }

            $arreglo=[];
            $arreglo['estado']='0';

            $cliente->where('id_cliente',$id_cliente)->update($arreglo);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
