<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    public function index()
    {
        try {
            $data=Permission::paginate(10);
            return view('permiso.index',['data'=>$data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {
        try {

            return view('permiso.create');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function store(Request $request)
    {
        try {
            Permission::create(['name' => Str::of($request->nombre)->trim()->lower()]);
            return redirect()->route('permiso.index')->with('success','Se grabo correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('permiso.create')->with('error',$th->getMessage());
        }
    }
}
