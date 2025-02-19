
<table>
    <thead>
        <tr>
            <th>codigo</th>
            <th>nombre categoria</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data_categoria as $item )
            <tr>
                <td>{{$item->id_categoria}}</td>
                <td>{{$item->nombre_categoria}}</td>
            </tr>
        @endforeach

    </tbody>
</table>
