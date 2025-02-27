<?php

namespace App\Http\Requests\cliente;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class Cliente_index_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $nombre_completo=Str::of(strip_tags($this->nombre_completo))->squish()->trim()->upper()->toString();

        $this->merge([
            'nombre_completo' =>$nombre_completo==''?null:$nombre_completo,
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre_completo'=>['nullable'],
            'sexo'=>['nullable','in:M,F']
        ];
    }

    public function attributes()
    {
        return [

        ];
    }

}
