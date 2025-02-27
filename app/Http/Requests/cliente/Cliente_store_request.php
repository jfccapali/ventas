<?php

namespace App\Http\Requests\cliente;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class Cliente_store_request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $nombres=Str::of(strip_tags($this->nombres))->squish()->trim()->upper()->toString();
        $apellido_paterno=Str::of(strip_tags($this->apellido_paterno))->squish()->trim()->upper()->toString();
        $apellido_materno=Str::of(strip_tags($this->apellido_materno))->squish()->trim()->upper()->toString();
        $direccion=Str::of(strip_tags($this->direccion))->squish()->trim()->toString();

        $this->merge([
            'nombres' =>$nombres==''?null:$nombres,
            'apellido_paterno' =>$apellido_paterno==''?null:$apellido_paterno,
            'apellido_materno' =>$apellido_materno==''?null:$apellido_materno,
            'direccion' =>$direccion==''?null:$direccion,
        ]);
    }

    public function rules(): array
    {
        return [
            'nombres'=>['required','min:3','max:255'],
            'apellido_paterno'=>['required','min:3','max:255'],
            'apellido_materno'=>['required','min:3','max:255'],
            'direccion'=>['required','min:5','max:255'],
            'sexo'=>['required','in:M,F'],
            'fecha_nacimiento'=>['required','date','date_format:Y-m-d'],
            'file_imagen'=>['nullable','file','mimetypes:img/png']
        ];
    }

    public function attributes()
    {
        return [
            'file_imagen'=>'foto'
        ];
    }
}
