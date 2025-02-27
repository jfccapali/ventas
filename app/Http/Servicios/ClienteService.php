<?php

namespace App\Http\Servicios;

use App\Http\Servicios\Service;
use App\Models\Cliente;
use Exception;

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

    public function store($nombres,$apellido_paterno,$apellido_materno,$direccion,$sexo,$fecha_nacimiento,$file_imagen)
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

    public function update(int $id_cliente,$nombres,$apellido_paterno,$apellido_materno,$direccion,$sexo,$fecha_nacimiento,$estado,$file_imagen)
    {
        try {

            $cliente=new Cliente();

            $cantidad_registros=$cliente->where('id_cliente',$id_cliente)->count();

            if($cantidad_registros==0){
                throw new Exception('Registro no encontrado');
            }

            $arreglo=[];
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
