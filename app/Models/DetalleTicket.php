<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleTicket extends Model
{
    protected $table = 'detalle_tickets';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function cliente()
    {
        return $this->hasOne(User::class);
    }

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

    public function falla()
    {
        return $this->belongsTo(Falla::class);
    }

    public function contratista()
    {
        return $this->belongsTo(Contratista::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function manpowers()
    {
        return $this->hasMany(Manpower::class, 'detalle_id');
    }

    public function getPendingValorationAttribute()
    {
        return $this->valoracion === 'Pendiente';
    }

    public function getAcceptedValorationAttribute()
    {
        return $this->valoracion === 'Si';
    }

    public function getRejectedValorationAttribute()
    {
        return $this->valoracion === 'No';
    }

    public function getValoracionTextAttribute()
    {
        if ($this->pending_valoration) {
            return 'Pendiente';
        }
        if ($this->accepted_valoration) {
            return 'Procede';
        }
        if ($this->rejected_valoration) {
            return 'No procede';
        }
    }

    public function toString()
    {
        return collect([$this->concepto?->nombre, $this->falla?->nombre])->filter()->join(' - ');
    }
}
