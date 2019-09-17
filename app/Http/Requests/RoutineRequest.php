<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoutineRequest extends FormRequest
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
            'user_id'            => 'required|integer',
            'nombre_rutina'      => 'required|string|max:255', 
            'fecha'              => 'required',
            'estado'             => 'required|string|max:255',
            ];
    }
}
