@extends('layout.adminlte.index')

@section('titulo','Listado de roles')

@section('contenido')

    <div class="card">
        <div class="card-header">
            LISTADO DE ROLES
            <a href="{{route('rol.create')}}" style="float: right" title="Crear nuevo rol" ><i class="fas fa-plus"></i></a>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>codigo</th>
                        <th>nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('rol.asignar_permiso',['id_rol'=>$item->id])}}" title="asignar permisos al rol: {{$item->name}}" ><i class="fab fa-php"></i></a>
                        </td>
                        <td></td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            {{$data->links()}}
                        </th>
                    </tr>
                </tfoot>
            </table>

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
