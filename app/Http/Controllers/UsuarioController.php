<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $data=User::select(['id_usuario','usuario','nombres','apellido_paterno','apellido_materno','direccion','sexo','fecha_nacimiento','nombre_imagen','fecha_imagen','estado'])->paginate(5);

            return view('usuario.index',['data'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function asignar_roles(int $id_usuario)
    {
        try {
            $data_usuario=User::select(["id_usuario"])->where('id_usuario',$id_usuario)->first();

            if($data_usuario==null){
                throw new Exception("Usuario no existe");
            }

            $data=Role::from('roles','t1')->select(['t1.id as codigo_rol','t1.name'])
                ->selectRaw("(select 1 from model_has_roles where role_id=t1.id and model_id=? ) as verificado",[$id_usuario])
                ->get();

            return view('usuario.asignar_roles',['data_roles'=>$data,'data_usuario'=>$data_usuario]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function asignar_roles_store(int $id_usuario,Request $request)
    {
        try {
            $data_usuario=User::where('id_usuario',$id_usuario)->first();

            if($data_usuario==null){
                throw new Exception("Usuario no existe");
            }

            $data_usuario->syncRoles($request->roles);

            return redirect()->route('usuario.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('usuario.asignar_roles',['id_usuario'=>$id_usuario])->with('error',$th->getMessage());
        }
    }

}
