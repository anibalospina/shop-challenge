<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customerName' => 'required|max:80',
            'customerEmail' => 'required|email|max:120',
            'customerMobile' => 'required|max:40',
            'description' => 'required|max:120',
            'total' => 'required|numeric',
            'currency' => 'max:10',
        ];
    }

    public function attributes()
    {
        return [
            'customerName' => 'Nombre',
            'customerEmail' => 'Correo electrónico',
            'customerMobile' => 'Celular',
            'description' => 'Descripción',
            'total' => 'Total',
            'currency' => 'Moneda',
        ];
    }
}
