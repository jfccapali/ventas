@extends('layout.adminlte.index')

@section('titulo','asignar permiso')

@section('contenido')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">ASIGNAR PERMISO</div>
            <div class="card-body">
                <form action="{{route('rol.asignar_permiso_store',['id_rol'=>$data_rol->id])}}" method="POST">
                    @csrf

                    <table class="table table-condensed table-bordered table-hover" style="font-size: 12px">
                        <tbody>
                            @foreach ( $data_permiso as $index => $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <input type="checkbox" name="permiso[{{$index}}]" {{$item->verificado=='1'?'checked':'' }} value="{{$item->name}}" >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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

