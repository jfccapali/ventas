@extends('layout.adminlte.index')

@section('titulo','Categoria crear')

@section('contenido')

<div class="row">
    <div class="col-12 col-md-10 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header text-white bg-primary">
                crear nueva categoria
            </div>
            <div class="card-body">
                <form action="{{route('categoria.store')}}" method="POST" id="formulario_crear" >
                    @csrf
                    <div class="form-group">
                        <label for="nombre_categoria">nombre categoria</label>
                        <input type="text" name="nombre_categoria" class="form-control" id="nombre_categoria" value="{{old('nombre_categoria')}}" >
                        <div class="error">@error('nombre_categoria') {{$message}} @enderror</div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="4" id="descripcion">{{old('descripcion')}}</textarea>
                        <div class="error">@error('descripcion') {{$message}} @enderror</div>
                    </div>
                    <button class="btn btn-primary" id="btnGuardar" ><i class="fas fa-save"></i>  Grabar</button>
                    <a class="btn btn-danger" href="{{route('categoria.index')}}" > <i class="fas fa-door-open"></i> Salir</a>
                </form>
            </div>
        </div>
    </div>
</div>




@error('id_categoria') <span>error</span> @enderror

<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
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
                title: 'Categoria',
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
