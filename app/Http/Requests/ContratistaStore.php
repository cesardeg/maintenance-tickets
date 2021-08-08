<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class ContratistaStore extends FormRequest
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
        $user = $this->route('contratista')
            ? User::whereHas('contratista', fn($cat) => $cat->whereId($this->route('contratista')))->first()
            : null;

        return [
            "desarrollador"           => "required|string",
            "municipio"               => "required|string",
            "proyecto"                => "required|string",
            "numero_contratista"      => "required|string|unique:contratistas,numero_contratista," . $this->route('contratista'),
            "empresa"                 => "required|string",
            "nombre"                  => "required|string",
            "correo"                  => "required|email|unique:users,email,{$user?->id}",
            "telefono"                => "required|digits:10",
            "fecha_producto_obra"     => "required|date_format:Y-m-d",
            "fecha_producto_vivienda" => "required|date_format:Y-m-d",
            "coordinador"             => "required|string",
            'atc_lunes_i'     => 'nullable|date_format:H:i',
            'atc_lunes_t'     => 'nullable|required_with:atc_lunes_i|date_format:H:i|after:atc_lunes_i',
            'atc_martes_i'    => 'nullable|date_format:H:i',
            'atc_martes_t'    => 'nullable|required_with:atc_martes_i|date_format:H:i|after:atc_martes_i',
            'atc_miercoles_i' => 'nullable|date_format:H:i',
            'atc_miercoles_t' => 'nullable|required_with:atc_miercoles_i|date_format:H:i|after:atc_miercoles_i',
            'atc_jueves_i'    => 'nullable|date_format:H:i',
            'atc_jueves_t'    => 'nullable|required_with:atc_jueves_i|date_format:H:i|after:atc_jueves_i',
            'atc_viernes_i'   => 'nullable|date_format:H:i',
            'atc_viernes_t'   => 'nullable|required_with:atc_viernes_i|date_format:H:i|after:atc_viernes_i',
            'atc_sabado_i'    => 'nullable|date_format:H:i',
            'atc_sabado_t'    => 'nullable|required_with:atc_sabado_i|date_format:H:i|after:atc_sabado_i',
            'atc_domingo_i'   => 'nullable|date_format:H:i',
            'atc_domingo_t'   => 'nullable|required_with:atc_domingo_i|date_format:H:i|after:atc_domingo_i',
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
            "desarrollador"           => "Desarrollador",
            "municipio"               => "Municipio",
            "proyecto"                => "required|string",
            "numero_contratista"      => "Proyecto urbanístico o frente",
            "empresa"                 => "Empresa de contratista",
            "nombre"                  => "Nombre del contratista responsable",
            "correo"                  => "Correo",
            "telefono"                => "Teléfono",
            "fecha_producto_obra"     => "Fecha de entrega del producto a obra",
            "fecha_producto_vivienda" => "Fecha de entrega del producto a entrega vivienda",
            "coordinador"             => "Coordinador de atención técnica asignado",
            'atc_lunes_i'     => 'Horario inicio Lunes',
            'atc_lunes_t'     => 'Horario fin Lunes',
            'atc_martes_i'    => 'Horario inicio Martes',
            'atc_martes_t'    => 'Horario fin Martes',
            'atc_miercoles_i' => 'Horario inicio Miércoles',
            'atc_miercoles_t' => 'Horario fin Miércoles',
            'atc_jueves_i'    => 'Horario inicio Jueves',
            'atc_jueves_t'    => 'Horario fin Jueves',
            'atc_viernes_i'   => 'Horario inicio Viernes',
            'atc_viernes_t'   => 'Horario fin Viernes',
            'atc_sabado_i'    => 'Horario inicio Sábado',
            'atc_sabado_t'    => 'Horario fin Sábado',
            'atc_domingo_i'   => 'Horario inicio Domingo',
            'atc_domingo_t'   => 'Horario fin Domingo',
        ];
    }
}