<?php

namespace App\Http\Requests\producto;

use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Producto_update_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $nombre_producto=Str::of(strip_tags($this->nombre_producto))->squish()->trim()->upper()->toString();
        $descripcion=Str::of(strip_tags($this->descripcion))->squish()->trim()->lower()->toString();

        $this->merge([
            'nombre_producto' =>$nombre_producto==''?null:$nombre_producto,
            'descripcion' =>$descripcion==''?null:$descripcion,
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre_producto'=>['required','min:3','max:255',Rule::unique(Producto::class,'nombre_producto')->ignore($this->route('id_producto'),'id_producto')],
            'descripcion'=>['nullable','min:5','max:500'],
            'categoria'=>['required','integer','exists:categorias,id_categoria'],
            'stock'=>['required','integer','min:0'],
            'precio'=>['required','numeric','min:0','decimal:0,2'],
            'estado'=>['required','in:1,0'],
            'imagen'=>['nullable','file','mimetypes:img/jpge,img/png','max:1024']
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
