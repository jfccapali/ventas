@extends('layout.adminlte.index')

@section('titulo','Categoria editar')

@section('contenido')

<div class="row">
    <div class="col-12 col-md-10 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header text-white bg-primary">
                editar categoria
            </div>
            <div class="card-body">
                <form action="{{route('categoria.update',['id_categoria'=>$data->id_categoria])}}" method="POST" id="formulario_editar" >
                    @csrf
                    <input type="hidden" name="_method" value="put" >
                    <div class="form-group">
                        <label for="nombre_categoria">Nombre categoria</label>
                        <input type="text" name="nombre_categoria" class="form-control" id="nombre_categoria" value="{{old('nombre_categoria',$data->nombre_categoria)}}" >
                        <div class="error">@error('nombre_categoria') {{$message}} @enderror</div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="4" id="descripcion">{{old('descripcion',$data->descripcion)}}</textarea>
                        <div class="error">@error('descripcion') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control" >
                            <option value=""> -- seleccione -- </option>
                            <option value="0" {{$data->estado=='0'?'selected':''  }} >Inactivo</option>
                            <option value="1" {{$data->estado=='1'?'selected':''  }} >Activo</option>
                        </select>
                    </div>

                    <button class="btn btn-primary" id="btnEditar" ><i class="fas fa-save"></i>  Guardar Cambios</button>
                    <a class="btn btn-danger" href="{{route('categoria.index')}}" > <i class="fas fa-door-open"></i> Salir</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    let cont=0;
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
        $("#btnEditar").click(function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Categoria',
                text: '¿Esta seguro de guardar los cambios?',
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
                    if(cont==0)
                    {
                        cont=1;
                        $("#btnEditar").attr('disabled',true);
                        $("#formulario_editar").submit();

                    }
                    else
                    {
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
