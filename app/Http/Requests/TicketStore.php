<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStore extends FormRequest
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
        $rules = [
            'condominio_id' => 'required|exists:condominios,id',
            'cliente_id' => "required|exists:clientes,id,condominio_id,{$this->condominio_id}",
            'created_at' => "nullable|date_format:Y-m-d H:i",
            'prototipo' => 'nullable|string',
            'detalles' => 'required|array|min:1',
            'detalles.*.familia_id' => 'required|exists:familias,id',
            'detalles.*.concepto_id' => 'required|exists:conceptos,id',
            'detalles.*.falla_id' => 'nullable|exists:fallas,id',
            'detalles.*.ubicacion_id' => 'required|exists:ubicaciones,id',
            'detalles.*.descripcion' => 'nullable|string',
        ];
        if ($this->user()->es_coordinador === false) {
            array_unshift($rules, [
                'condominio_id' => 'required|exists:condominios,id',
                'cliente_id' => "required|exists:clientes,id,condominio_id,{$this->condominio_id}",
            ]);
        }
        return $rules;
    }

    public function attributes()
    {
        $number = 1;
        $attributes = [
            'condominio_id' => 'Condominio',
            'cliente_id' => 'Cliente',
            'detalles' => 'Fallas',
        ];
        foreach ($this->detalles ?? [] as $i => $detalle) {
            $attributes = array_merge($attributes, [
                "detalles.{$i}.familia_id" => "Familia #{$number}",
                "detalles.{$i}.concepto_id" => "Concepto #{$number}",
                "detalles.{$i}.falla_id" => "Falla #{$number}",
                "detalles.{$i}.ubicacion_id" => "Ubicación #{$number}",
                "detalles.{$i}.descripcion" => "Descripción #{$number}",
            ]);
            $number++;
        }
        return $attributes;
    }
}
