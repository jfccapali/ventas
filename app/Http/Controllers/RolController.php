<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function index()
    {
        try {
            $data=Role::paginate(10);
            return view('rol.index',['data'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {
        try {

            return view('rol.create');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function store(Request $request)
    {
        try {
            Role::create(['name' => Str::of($request->nombre)->trim()->upper()]);
            return redirect()->route('rol.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('rol.create')->with('error',$th->getMessage());
        }
    }

    public function asignar_permiso($id_rol)
    {
        try {

            $data_rol=Role::where('id',$id_rol)->first();

            $data_permiso=Permission::from('permissions','t1')->select(['t1.name','t1.id'])
                ->selectRaw("(select 1 from role_has_permissions where role_id=? and permission_id=t1.id) as verificado",[$id_rol])->get();

            return view('rol.asignar_permiso',['data_rol'=>$data_rol,'data_permiso'=>$data_permiso]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function asignar_permiso_store($id_rol,Request $request)
    {
        try {
            $data_rol=Role::where('id',$id_rol)->first();

            $data_rol->syncPermissions($request->permiso);

            return redirect()->route('rol.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('rol.asignar_permiso')->with('error',$th->getMessage());
        }
    }

}
