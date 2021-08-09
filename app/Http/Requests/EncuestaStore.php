<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncuestaStore extends FormRequest
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
            'pregunta_1' => 'required|integer|min:1|max:10',
            'pregunta_2' => 'required|integer|min:1|max:10',
            'pregunta_3' => 'required|integer|min:1|max:10',
            'pregunta_4' => 'required|integer|min:1|max:10',
            'pregunta_5' => 'required|integer|min:1|max:10',
        ];
    }
}
