<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'user_id'                   => 'required|integer',
            'nombre'                    => 'required|string|max:255',
            'departamento'              => 'required|string|max:255',
            'descripcion'               => 'required|string|max:255',
            'estado'                    => 'required|string|max:255',    
            ];
    }
}
