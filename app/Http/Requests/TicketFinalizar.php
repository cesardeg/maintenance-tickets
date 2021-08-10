<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketFinalizar extends FormRequest
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
            'fecha_finalizado' => 'nullable|date',
            'observacion_fin' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'fecha_finalizado' => 'Fecha de finalizado',
            'observacion_fin' => 'Comentarios',
        ];
    }
}
