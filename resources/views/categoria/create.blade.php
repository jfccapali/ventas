<form action="{{route('categoria.store')}}" method="POST" >
    @csrf
    <label for="">nombre categoria</label>
    <input type="text" name="nombre_categoria" >
    <label for="">descripcion</label>
    <textarea name="descripcion" cols="30" rows="4"></textarea>
    <button>grabar</button>
</form>
