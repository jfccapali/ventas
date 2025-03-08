<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte Ventas</title>
    <style>
        body{
            height: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: 0;
            padding: 0;
        }

        header{
            height: 5cm;
            left: 2cm;
            right: 3cm;
            bottom: 2.5cm;
            border: solid 1px black;
        }

        main{
            left: 2cm;
            right: 3cm;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <header>

    </header>

    <main>
        <table style="border: solid 1px black;">
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
                @forelse ($data as $indice =>$item)
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
    </main>
</body>
</html>
