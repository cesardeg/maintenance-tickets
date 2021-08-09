<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleContratista extends FormRequest
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
            'contratista_id' => 'required|exists:contratistas,id',
            'agendado_desde' => 'required|date_format:Y-m-d H:i:s',
            'agendado_hasta' => 'required|date_format:Y-m-d H:i:s|after:agendado_desde',
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
            'contratista_id' => 'Contratista',
            'agendado_desde' => 'Fecha de inicio contratista',
            'agendado_hasta' => 'Fecha de fin contratista',
        ];
    }
}
