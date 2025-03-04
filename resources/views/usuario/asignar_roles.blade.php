@extends('layout.adminlte.index')

@section('titulo','asignar roles')

@section('contenido')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">ASIGNAR ROLES</div>
            <div class="card-body">
                <form action="{{route('usuario.asignar_roles_store',['id_usuario'=>$data_usuario->id_usuario])}}" method="POST">
                    @csrf

                    <table class="table table-condensed table-bordered table-hover" style="font-size: 12px">
                        <tbody>
                            @foreach ( $data_roles as $index => $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <input type="checkbox" name="roles[{{$index}}]" {{$item->verificado=='1'?'checked':'' }} value="{{$item->name}}" >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-primary" id="btnGuardar" ><i class="fas fa-save"></i>  Grabar</button>
                    <a class="btn btn-danger" href="{{route('usuario.index')}}" > <i class="fas fa-door-open"></i> Salir</a>
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

