@extends('layout.adminlte.index')

@section('titulo','Categoria listado')

@section('contenido')
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-header text-white bg-primary">
                listado de categoria
                <a href="{{route('categoria.create')}}" style="float: right" title="Crear nueva categoria" ><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>codigo</th>
                            <th>nombre categoria</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data_categoria as $item )
                            <tr>
                                <td>{{$item->id_categoria}}</td>
                                <td>{{$item->nombre_categoria}}</td>
                                <td>
                                    <a class="btn btn-primary" title="{{'editar: '.$item->nombre_categoria}}" href="{{route('categoria.edit',['id_categoria'=>$item->id_categoria])}}" ><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('categoria.delete',['id_categoria'=>$item->id_categoria])}}">
                                        <button class="btn btn-danger" title="{{'eliminar: '.$item->nombre_categoria}}" > <i class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
