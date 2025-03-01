<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login()
    {
        try {
            return view('login.login');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function login_verifica(Request $request)
    {
        try {
            $recuerdame=$request->filled('recuerdame');
            $data_user=User::where('usuario',$request->usuario)->first();

            if($data_user==null){
                throw new Exception("usuario no existe");
            }

            if(!password_verify($request->contrasena,$data_user->contrasena)){
                throw new Exception("usuario y/o contraseña incorrecta");
            }

            Auth::login($data_user,$recuerdame);

            echo Auth::user()->nombres;

            return redirect()->route('bienvenido')->with('sucess','Se logueo correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('login');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function index()
    {
        try {

            return view('login.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
