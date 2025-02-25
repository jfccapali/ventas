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
                            <th>descripcion</th>
                            <th>estado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data_categoria as $item )
                            <tr>
                                <td>{{$item->id_categoria}}</td>
                                <td>{{$item->nombre_categoria}}</td>
                                <td>{{$item->descripcion}}</td>
                                <td style="text-align: center" >
                                    @if ($item->estado=='1')
                                        <span class="alert alert-success">
                                            <strong>Activo</strong>
                                        </span>
                                    @else
                                        <span class="alert alert-danger">
                                            <strong>Inactivo</strong>
                                        </span>
                                    @endif

                                </td>
                                <td style="text-align: center" >
                                    <a class="btn btn-primary" title="{{'editar: '.$item->nombre_categoria}}" href="{{route('categoria.edit',['id_categoria'=>$item->id_categoria])}}" ><i class="fas fa-edit"></i></a>
                                </td>
                                <td style="text-align: center" >
                                    @if ($item->estado=='1')
                                        <form action="{{route('categoria.delete',['id_categoria'=>$item->id_categoria])}}"  method="post" class="formulario_eliminar" >
                                            @csrf
                                            <input type="hidden" name="_method" value="delete" >
                                            <button class="btn btn-danger btn_eliminar" title="{{'eliminar: '.$item->nombre_categoria}}" > <i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center" >
                    {{$data_categoria->links()}}
                </div>
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

    $(function(){
        let cont=0;

        $(".btn_eliminar").click(function(e){
            e.preventDefault();


            Swal.fire({
                title: 'Categoria',
                text: '¿Esta seguro de eliminar?',
                icon: 'question',
                showCancelButton: true,
                allowOutsideClick:false,
                allowEscapeKey:false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro',
                cancelButtonText:'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    if(cont==0){
                        cont=1;
                        let padre=$(this).parents('.formulario_eliminar');
                        $(this).attr('disabled',true);
                        setInterval(() => {
                            padre.submit();
                        }, 2000);

                    }else{
                        Swal.fire({
                            icon:'info',
                            text:'El formulario ya fue enviado'
                        });
                    }
                }
            });

        });
    });

    </script>
@endsection
