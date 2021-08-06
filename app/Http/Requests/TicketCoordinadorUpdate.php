<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCoordinadorUpdate extends FormRequest
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
            'cat_id' => 'nullable|exists:cat,id',
            'cita_cat' => 'nullable|required_with:cat_id|date_format:Y-m-d H:i:s',
            'cita_cat_fin' => 'nullable|required_with:cat_id|date_format:Y-m-d H:i:s|after:cita_cat',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'cat_id' => 'Coordinador de atención técnica (CAT)',
            'cita_cat' => 'Fecha de inicio cita',
            'cita_cat_fin' => 'Fecha de fin cita',
        ];
    }
}
