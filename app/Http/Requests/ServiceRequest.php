<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        'razon_social'      => 'required|string|max:255', 
        'servicio'          => 'required|string|max:255',
        'direccion'         => 'required|string|max:255',
        'telefono'          => 'required|string|max:255',
        'web'               => 'required|string|max:255',
        'email'             => 'required|string|email|max:255',
        'contacto'          => 'required|string|max:255',
        'estado'            => 'required|string|max:255',
        ];
    }
}
