<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //Relationships
    public function cliente() {
        return $this->hasOne('App\Cliente', 'id', 'cliente_id');
    }

    public function coordinador() {
        return $this->hasOne('App\Coordinador', 'id', 'cat_id');
    }

    public function contratista() {
        return $this->hasOne('App\Contratista', 'id', 'contratista_id');
    }

    public function detalle() {
        return $this->hasMany('App\DetalleTicket');
    }

    public function encuestas() {
        return $this->hasMany('App\Encuesta');
    }
}
