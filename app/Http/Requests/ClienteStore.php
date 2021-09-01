<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStore extends FormRequest
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
        $clienteId = $this->route('cliente')?->id ?? null;
        $condominioId = $this->Condominio;
        $userId = $this->route('cliente')?->user_id ?? null;

        return [
            'Desarrollador' => 'required|string',
            'Municipio' => 'required|string',
            'Condominio' => 'required|exists:condominios,id',
            'Numero_cliente' => "required|unique:clientes,numero_cliente,{$clienteId},id,condominio_id,{$condominioId}",
            'Nombre_completo' => 'required|string',
            'Coopropietario' => 'nullable|string',
            'Correo' => "required|email|unique:users,email,{$userId}",
            'Telefono' => 'required|digits:10',
            'Fecha_escrituracion' => 'required|date_format:Y-m-d',
            'Fecha_poliza' => 'required|date_format:Y-m-d',
            'Fecha_entrega' => 'required|date_format:Y-m-d',
            'Comentarios' => 'nullable|string'
        ];
    }
}
