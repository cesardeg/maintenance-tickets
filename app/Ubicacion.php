<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    public function detalle() {
        return $this->hasOne('App\DetalleTicket');
    }
}
