<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionalRequest extends FormRequest
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
        'estado'                    => 'required|string|max:255',
        'mision'                    => 'required|string|max:255',
        'vision'                    => 'required|string|max:255',
        'direccion'                 => 'required|string|max:255',
        'telefono'                  => 'required|string|max:255',
        'web'                       => 'required|string|max:255',
        'email'                     => 'required|string|max:255',
        'contacto'                  => 'required|string|max:255',
        'user_id'                   => 'required|integer',
        ];
    }
}
