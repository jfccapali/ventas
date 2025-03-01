@extends('layout.adminlte.index')

@section('titulo','LOGIN')

@section('contenido')
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-10 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-header text-white bg-primary ">INICIAR SESION</div>
                <div class="card-body">
                    <form action="{{route('login.login_verifica')}}"  method="post" >
                        @csrf
                        <div class="form-group">
                            <label for="usuario">USUARIO</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="contrasena">CONTRASEÑA</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control" >
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="recuerdame" value="1"> Recuerdame
                            </label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"> <i class="fas fa-sign-in-alt"></i> INGRESAR </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
