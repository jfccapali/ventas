@extends('layout.adminlte.index')

@section('titulo','Crear nuevo Producto')

@section('contenido')
<div class="row d-flex justify-content-center">
    <div class="col-12 col-sm-11 col-md-8 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header text-white bg-primary">CREAR NUEVO PRODUCTO</div>
            <div class="card-body">
                <form action="{{route('producto.store')}}" method="post" >
                    @csrf
                    <div class="form-group">
                        <label for="nombre_producto" >Nombre Producto</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="{{old('nombre_producto')}}" >
                        <div class="error">@error('nombre_producto') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" >{{old('descripcion')}}</textarea>
                        <div class="error">@error('descripcion') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria"  class="form-control" >
                            <option value=""> -- seleccione -- </option>
                            @foreach ($data_categoria as $item )
                                <option value="{{$item->id_categoria}}" {{old('categoria')==$item->id_categoria?'selected':'' }} >{{$item->nombre_categoria}}</option>
                            @endforeach
                        </select>
                        <div class="error">@error('categoria') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="stock" >Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{old('stock')}}" >
                        <div class="error">@error('stock') {{$message}} @enderror</div>
                    </div>
                    <div class="form-group">
                        <label for="precio" >Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="{{old('precio')}}" >
                        <div class="error">@error('precio') {{$message}} @enderror</div>
                    </div>
                    <button class="btn btn-primary" id="btnGuardar" ><i class="fas fa-save"></i>  Grabar</button>
                    <a class="btn btn-danger" href="{{route('producto.index')}}" > <i class="fas fa-door-open"></i> Salir</a>
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
