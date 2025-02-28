@extends('layout.adminlte.index')

@section('titulo','Cliente editar')

@section('contenido')

<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-10 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header text-white bg-primary">
                editar cliente {{$data->apellido_paterno}} {{$data->apellido_materno}} {{', '.$data->nombres}}
            </div>
            <div class="card-body">
                <form action="{{route('cliente.update',['id_cliente'=>$data->id_cliente])}}" method="POST" id="formulario_crear" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label >Nombres</label>
                        <input type="text" name="nombres" class="form-control"  value="{{old('nombres',$data->nombres)}}" >
                        <div class="error">@error('nombres') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" class="form-control"  value="{{old('apellido_paterno',$data->apellido_paterno)}}" >
                        <div class="error">@error('apellido_paterno') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Apellido Materno</label>
                        <input type="text" name="apellido_materno" class="form-control"  value="{{old('apellido_materno',$data->apellido_materno)}}" >
                        <div class="error">@error('apellido_materno') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <textarea name="direccion" class="form-control" rows="4" id="direccion">{{old('direccion',$data->direccion)}}</textarea>
                        <div class="error">@error('direccion') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" class="form-control" >
                            <option value=""> -- seleccion -- </option>
                            <option value="M" {{old('sexo',$data->sexo)=='M'?'selected':'' }} >Masculino</option>
                            <option value="F" {{old('sexo',$data->sexo)=='F'?'selected':'' }} >Femenino</option>
                        </select>
                        <div class="error">@error('sexo') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Fecha Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control"  value="{{old('fecha_nacimiento',$data->fecha_nacimiento)}}" >
                        <div class="error">@error('fecha_nacimiento') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Foto</label>
                        <input type="file" class="form-control-file border" name="foto" >
                        <div class="error">@error('foto') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" >
                            <option value=""> -- seleccion -- </option>
                            <option value="0" {{old('estado',$data->estado)=='0'?'selected':'' }} >Inactivo</option>
                            <option value="1" {{old('estado',$data->estado)=='1'?'selected':'' }} >Activo</option>
                        </select>
                        <div class="error">@error('estado') {{$message}} @enderror</div>
                    </div>
                    <button class="btn btn-primary" id="btnGuardar" ><i class="fas fa-save"></i>  Guardar los cambios</button>
                    <a class="btn btn-danger" href="{{route('cliente.index')}}" > <i class="fas fa-door-open"></i> Salir</a>
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
        $("#btnGuardar").click(function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Cliente',
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
                        $("#formulario_crear").submit();
                        $("#btnGuardar").attr('disabled',true);
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
