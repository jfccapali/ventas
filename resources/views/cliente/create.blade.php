@extends('layout.adminlte.index')

@section('titulo','Cliente crear')

@section('contenido')

<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-10 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header text-white bg-primary">
                crear nuevo cliente
            </div>
            <div class="card-body">
                <form action="{{route('cliente.store')}}" method="POST" id="formulario_crear" >
                    @csrf
                    <div class="form-group">
                        <label >Nombres</label>
                        <input type="text" name="nombres" class="form-control"  value="{{old('nombres')}}" >
                        <div class="error">@error('nombres') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" class="form-control"  value="{{old('apellido_paterno')}}" >
                        <div class="error">@error('apellido_paterno') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Apellido Materno</label>
                        <input type="text" name="apellido_materno" class="form-control"  value="{{old('apellido_materno')}}" >
                        <div class="error">@error('apellido_materno') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <textarea name="direccion" class="form-control" rows="4" id="direccion">{{old('direccion')}}</textarea>
                        <div class="error">@error('direccion') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" class="form-control" >
                            <option value=""> -- seleccion -- </option>
                            <option value="M" {{old('sexo')=='M'?'selected':'' }} >Masculino</option>
                            <option value="F" {{old('sexo')=='F'?'selected':'' }} >Femenino</option>
                        </select>
                        <div class="error">@error('sexo') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label >Fecha Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control"  value="{{old('fecha_nacimiento')}}" >
                        <div class="error">@error('fecha_nacimiento') {{$message}} @enderror</div>
                    </div>
                    <button class="btn btn-primary" id="btnGuardar" ><i class="fas fa-save"></i>  Grabar</button>
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
                text: '¿Esta seguro de grabar?',
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
