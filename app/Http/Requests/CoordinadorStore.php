<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CoordinadorStore extends FormRequest
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
        $id = $this->route()->originalParameter('cat');
        $user = $id
            ? User::whereHas('cat', fn($cnt) => $cnt->whereId($id))->first()
            : null;

        return [
            "Desarrollador"    => "required|string",
            "Municipio"        => "required|string",
            "Proyecto"         => "required|string",
            "Numero_cat"       => "required|integer|unique:cat,numero_cat,{$id}",
            "Nombre_cat"       => "required|string",
            "Correo"           => "required|email|unique:users,email,{$user?->id}",
            "Telefono"         => "required|digits:10",
            'acat_lunes_i'     => 'nullable|date_format:H:i',
            'acat_lunes_t'     => 'nullable|required_with:acat_lunes_i|date_format:H:i|after:acat_lunes_i',
            'acat_martes_i'    => 'nullable|date_format:H:i',
            'acat_martes_t'    => 'nullable|required_with:acat_martes_i|date_format:H:i|after:acat_martes_i',
            'acat_miercoles_i' => 'nullable|date_format:H:i',
            'acat_miercoles_t' => 'nullable|required_with:acat_miercoles_i|date_format:H:i|after:acat_miercoles_i',
            'acat_jueves_i'    => 'nullable|date_format:H:i',
            'acat_jueves_t'    => 'nullable|required_with:acat_jueves_i|date_format:H:i|after:acat_jueves_i',
            'acat_viernes_i'   => 'nullable|date_format:H:i',
            'acat_viernes_t'   => 'nullable|required_with:acat_viernes_i|date_format:H:i|after:acat_viernes_i',
            'acat_sabado_i'    => 'nullable|date_format:H:i',
            'acat_sabado_t'    => 'nullable|required_with:acat_sabado_i|date_format:H:i|after:acat_sabado_i',
            'acat_domingo_i'   => 'nullable|date_format:H:i',
            'acat_domingo_t'   => 'nullable|required_with:acat_domingo_i|date_format:H:i|after:acat_domingo_i',
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
            'Numero_cat'      => 'Número de CAT',
            'Telefono'        => 'Teléfono',
            'acat_lunes_i'     => 'Horario inicio Lunes',
            'acat_lunes_t'     => 'Horario fin Lunes',
            'acat_martes_i'    => 'Horario inicio Martes',
            'acat_martes_t'    => 'Horario fin Martes',
            'acat_miercoles_i' => 'Horario inicio Miércoles',
            'acat_miercoles_t' => 'Horario fin Miércoles',
            'acat_jueves_i'    => 'Horario inicio Jueves',
            'acat_jueves_t'    => 'Horario fin Jueves',
            'acat_viernes_i'   => 'Horario inicio Viernes',
            'acat_viernes_t'   => 'Horario fin Viernes',
            'acat_sabado_i'    => 'Horario inicio Sábado',
            'acat_sabado_t'    => 'Horario fin Sábado',
            'acat_domingo_i'   => 'Horario inicio Domingo',
            'acat_domingo_t'   => 'Horario fin Domingo',
        ];
    }
}
