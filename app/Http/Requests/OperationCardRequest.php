<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationCardRequest extends FormRequest
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
            
            'user_id'           => 'required|integer',
            'nit'               => 'required|string|max:255',
            'empresa'           => 'required|string|max:255',
            'descripcion'       => 'required|string|max:255',
            'fecha_registro'    => 'required',
            'fecha_vigencia'    => 'required',
            'responsable'       => 'required|string|max:255',
            'telefono'          => 'required|string|max:255',
            'email'             => 'required|string|max:255',
            'estado'            => 'required|string|max:255',
        ];
    }
}
