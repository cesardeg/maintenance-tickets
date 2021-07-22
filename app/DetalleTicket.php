<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTicket extends Model
{
    protected $table = 'detalle_tickets';

    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }

    public function cliente() {
        return $this->hasOne('App\User');
    }

    public function familia() {
        return $this->belongsTo('App\Familia');
    }

    public function concepto() {
        return $this->belongsTo('App\Concepto');
    }

    public function falla() {
        return $this->belongsTo('App\Falla');
    }

    public function contratista() {
        return $this->belongsTo('App\Contratista');
    }

    public function ubicacion() {
        return $this->belongsTo('App\Ubicacion');
    }
}
