@extends('layout.adminlte.index')

@section('titulo','REGISTRAR VENTA')


@section('contenido')

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-white bg-primary ">
                REGISTRAR VENTA
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label >Cliente</label>
                            <input type="text"  name="cliente" id="cliente" class="form-control" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="producto">Productos: </label>
                            <select class="form-control" id="producto" data-allow-clear="1" data-select2-id="1" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true"   >
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" id="cantidad" class="form-control" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-condensed-table-sm-table-bordered" id="tbl_productos" >
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>codigo producto</th>
                            <th>nombre_producto</th>
                            <th>cantidad</th>
                            <th>precio</th>
                            <th>importe</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="btn_grabar" > Grabar venta</button>
            </div>
        </div>
    </div>
</div>

@endsection



@section('js')
    <script src="{{asset('js/venta/registrar_venta.js')}}"></script>
    <script>

    </script>
@endsection
