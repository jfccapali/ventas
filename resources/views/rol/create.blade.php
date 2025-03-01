@extends('layout.adminlte.index')

@section('titulo','crear nuevo roles')

@section('contenido')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">NUEVO ROL</div>
            <div class="card-body">
                <form action="{{route('rol.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label >nombre rol</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <button class="btn btn-primary" id="btnGuardar" ><i class="fas fa-save"></i>  Grabar</button>
                    <a class="btn btn-danger" href="{{route('rol.index')}}" > <i class="fas fa-door-open"></i> Salir</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
    <script>
        @if (session()->has('error'))
        Swal.fire({
            icon: 'error',
            text: '{{session('error')}}'
        });
        @endif

        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                text: '{{session('success')}}'
            });
        @endif
    </script>
@endsection

