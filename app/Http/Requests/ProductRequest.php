<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'user_id'               => 'required|integer',
            'type_id'               => 'required|integer',
            'nombre'                => 'required|string|max:255',
            'presentacion'          => 'required|string|max:255',
            'precio'                => 'required|numeric|between:0,99999999.99',
            'estado'                => 'required|string|max:255',
        ];
    }
}
