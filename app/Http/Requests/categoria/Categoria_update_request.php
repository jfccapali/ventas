<?php

namespace App\Http\Requests\categoria;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Categoria_update_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $nombre_categoria=Str::of(strip_tags($this->nombre_categoria))->squish()->trim()->upper()->toString();
        $descripcion=Str::of(strip_tags($this->descripcion))->squish()->trim()->lower()->toString();

        $this->merge([
            'nombre_categoria' =>$nombre_categoria==''?null:$nombre_categoria,
            'descripcion' =>$descripcion==''?null:$descripcion,
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre_categoria'=>['required','min:3','max:255',Rule::unique(Categoria::class,'nombre_categoria')->ignore($this->route('id_categoria'),'id_categoria')],
            'descripcion'=>['nullable','min:5','max:500'],
            'estado'=>['required','in:1,0']
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
