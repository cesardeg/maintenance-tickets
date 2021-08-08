<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manpower extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['agendado_desde', 'agendado_hasta', 'trabajado_desde', 'trabajado_hasta'];

    public function detalle()
    {
        return $this->belongsTo(DetalleTicket::class);
    }

    public function contratista()
    {
        return $this->belongsTo(Contratista::class);
    }

    public function ticket()
    {
        return $this->hasOneThrough(Ticket::class, DetalleTicket::class, 'id', 'id', 'detalle_id', 'ticket_id');
    }
}
