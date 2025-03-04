@extends('layout.adminlte.index')

@section('titulo','BIENVENIDO')

@section('contenido')
    <p>BIENVENIDO MUJER</p>
    <br>
    {{Auth::user()}}

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
