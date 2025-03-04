@extends('layout.adminlte.index')

@section('titulo','REGISTRAR VENTA')


@section('contenido')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-white bg-primary ">
                REGISTRAR VENTA
            </div>
            <div class="card-body ">
                <form action="{{route('venta.registrar_venta_store')}}" class="row" method="post" >
                    @csrf
                    <div class="col-12">
                        <div class="form-group">
                            <label >Cliente</label>
                            <select name="cliente" id="cliente" class="form-control" >
                                <option value=""> -- seleccione -- </option>
                                @foreach ($data_cliente as $item)
                                    <option value="{{$item->id_cliente}}">{{$item->apellido_paterno}} {{$item->apellido_materno}} {{', '.$item->nombres}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection



@section('js')
    <script>

    </script>
@endsection
