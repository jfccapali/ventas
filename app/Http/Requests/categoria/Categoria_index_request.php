<?php

namespace App\Http\Requests\categoria;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class Categoria_index_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $id_categoria=Str::of(strip_tags($this->id_categoria))->squish()->trim()->toString();

        $this->merge([
            'id_categoria' =>$id_categoria==''?null:$id_categoria,
        ]);
    }

    public function rules(): array
    {
        return [
            'id_categoria'=>'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'id_categoria' => 'codigo categoria',
        ];
    }
}
