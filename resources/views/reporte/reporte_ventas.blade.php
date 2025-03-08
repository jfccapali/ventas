@extends('layout.adminlte.index')

@section('titulo','REPORTE DE VENTAS')

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">REPORTE DE VENTAS</div>
            <div class="card-body">
                <form action="{{route('reporte.reporte_ventas')}}" method="get">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label >Productos</label>
                                <select name="producto" class="form-control" >
                                    <option value=""> -- seleccione -- </option>
                                    @foreach ($data_producto as $item )
                                        <option value="{{$item->id_producto}}">{{$item->nombre_producto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label >Clientes</label>
                                <select name="cliente" class="form-control" >
                                    <option value=""> -- seleccione -- </option>
                                    @foreach ($data_cliente as $item )
                                        <option value="{{$item->id_cliente}}">{{$item->apellido_paterno}} {{$item->apellido_materno}}, {{$item->nombres}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label >Codigo Venta</label>
                                <input type="number" name="codigo_venta" class="form-control" >
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary">Consultar</button>
                            <a href="{{route('pdf.reporte_ventas')}}" class="btn btn-primary" target="_blank" > Exportar PDF</a>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-condensed table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Codigo Venta</th>
                            <th>Fecha Venta</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Importe de venta</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_reporte as $indice =>$item)
                            <tr>
                                <td>{{$indice +1}}</td>
                                <td>{{$item->id_venta}}</td>
                                <td>{{$item->fecha_creacion}}</td>
                                <td>{{$item->nombre_cliente}}</td>
                                <td>{{$item->nombre_vendedor}}</td>
                                <td>{{$item->importe_venta}}</td>
                                <td>{{$item->estado_transaccion}}</td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="7">No se encontro resultados</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
