<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarTrabajo extends FormRequest
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
            'finalizado'      => 'required|boolean',
            'trabajado_desde' => 'nullable|required_if:finalizado,1|date_format:Y-m-d H:i:s',
            'trabajado_hasta' => 'nullable|required_if:finalizado,1|date_format:Y-m-d H:i:s|after:trabajado_desde',
        ];
    }
}
