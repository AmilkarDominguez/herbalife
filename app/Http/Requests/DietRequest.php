<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DietRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',

            'desayuno' => 'required|string|max:255',
            'merienda_am' => 'required|string|max:255',
            'almuerzo' => 'required|string|max:255',
            'merienda_pm' => 'required|string|max:255',
            'cena' => 'required|string|max:255',

            'estado' => 'required|string|max:255',

        ];
    }
}
