<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    public function detalle()
    {
        return $this->hasOne(DetalleTicket::class);
    }
}
