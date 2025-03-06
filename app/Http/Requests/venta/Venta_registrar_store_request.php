<?php

namespace App\Http\Requests\venta;

use Illuminate\Foundation\Http\FormRequest;

class Venta_registrar_store_request extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente'=>['required','integer','min:1','exists:clientes,id_cliente'],
            'producto_codigo'=>['required','array','min:1'],
            'producto_codigo.*'=>['required','integer','min:1','exists:productos,id_producto'],
            'producto_cantidad'=>['required','array','min:1'],
            'producto_cantidad.*'=>['required','integer','min:1']
        ];
    }
}
