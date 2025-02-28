@extends('layout.adminlte.index')

@section('titulo','Cliente listado')

@section('contenido')
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-header text-white bg-primary">
                listado de clientes
                <a href="{{route('cliente.create')}}" style="float: right" title="Crear nueva cliente" ><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <form class="row" action="{{route('cliente.index')}}" method="get" >
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label >Nombres</label>
                            <input type="text" class="form-control" name="nombre_completo" value="{{$persistencia['nombre_completo']}}" >
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label >Sexo</label>
                            <select class="form-control" name="sexo" >
                                <option value=""> -- seleccione -- </option>
                                <option value="M" {{$persistencia['sexo']=='M'?'selected':''  }} >Masculino</option>
                                <option value="F" {{$persistencia['sexo']=='F'?'selected':''  }} >Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary"><i class="fas fa-search"></i> Consultar </button>
                        <a class="btn btn-danger" href="{{route('cliente.index')}}" > <i class="fas fa-times"></i> Cancelar</a>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>codigo</th>
                            <th>foto</th>
                            <th>nombre cliente</th>
                            <th>direccion</th>
                            <th>sexo</th>
                            <th>fecha nacimiento</th>
                            <th>estado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $item )
                            <tr>
                                <td>{{$item->id_cliente}}</td>
                                <td>
                                    @if ($item->nombre_imagen)
                                        <img src="{{asset('storage/cliente/'.$item->nombre_imagen.'?fecha='.$item->fecha_imagen)}}" style="max-width: 150px" class="mx-auto d-block img-thumbnail img-fluid">
                                    @endif
                                </td>
                                <td>{{$item->apellido_paterno}} {{$item->apellido_materno}} {{', '.$item->nombres}}</td>
                                <td>{{$item->direccion}}</td>
                                <td>{{$item->sexo}}</td>
                                <td>{{$item->fecha_nacimiento}}</td>
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
                                    <a class="btn btn-primary" title="{{'editar: '.$item->apellido_paterno.' '.$item->apellido_materno.', '.$item->nombres}}" href="{{route('cliente.edit',['id_cliente'=>$item->id_cliente])}}" ><i class="fas fa-edit"></i></a>
                                </td>
                                <td style="text-align: center" >
                                    @if ($item->estado=='1')
                                        <form action="{{route('cliente.delete',['id_cliente'=>$item->id_cliente])}}"  method="post" class="formulario_eliminar" >
                                            @csrf
                                            <input type="hidden" name="_method" value="delete" >
                                            <button class="btn btn-danger btn_eliminar" title="{{'eliminar: '.$item->apellido_paterno.' '.$item->apellido_materno.', '.$item->nombres}}" > <i class="fas fa-trash-alt"></i> </button>
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
                    {{$data->links()}}
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
                title: 'Cliente',
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

