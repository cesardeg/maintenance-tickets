<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['cita_cat', 'cita_cat_fin'];

    //Relationships
    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function coordinador()
    {
        return $this->belongsTo(Coordinador::class, 'cat_id');
    }

    public function contratistas()
    {
        return $this->belongsToMany(Contratista::class, 'detalle_tickets');
    }    

    public function detalles()
    {
        return $this->hasMany(DetalleTicket::class);
    }

    public function manpowers()
    {
        return $this->hasManyThrough(Manpower::class, DetalleTicket::class, 'ticket_id', 'detalle_id');
    }

    public function encuestas()
    {
        return $this->hasMany(Encuesta::class);
    }

    public function encuesta()
    {
        return $this->hasOne(Encuesta::class)->latest();
    }


    // scopes
    public function scopeBuscar($qry, $text = '')
    {
        $escaped = escape_like($text);
        $pattern = "%{$escaped}%";
        return $qry->where(fn ($where) => 
            $where->orWhere('tickets.id', $escaped)
                ->orWhereHas('condominio', fn($has) => $has->where('condominios.nombre', 'LIKE',  $pattern))
                ->orWhereHas('cliente', fn($has) => $has->where('clientes.nombre', 'LIKE',  $pattern)->orWhere('clientes.numero_cliente', 'LIKE',  $pattern))
                ->orWhereHas('coordinador', fn($has) => $has->where('cat.nombre', 'LIKE',  $pattern))
                ->orWhereHas('contratistas', fn($has) => $has->where('contratistas.nombre', 'LIKE',  $pattern))
        );
    }
    
    // getters
    public function getNombreEstadoAttribute()
    {
        return TicketStatus::getName($this->estado);
    }

    public function getNoFinalizadoAttribute()
    {
        return $this->estado < TicketStatus::FINISHED;
    }

    public function getFinalizadoAttribute()
    {
        return $this->estado == TicketStatus::FINISHED;
    }

    public function getRatedAttribute()
    {
        return $this->estado == TicketStatus::RATED;
    }
}

abstract class TicketStatus {
    const PENDING = 0;
    const APPRAISING = 1;
    const NOT_APPLICABLE = 2;
    const IN_PROGRESS = 3;
    const FINISHED = 4;
    const RATED = 5;

    public static function getName($status)
    {
        if ($status === self::PENDING) {
            return 'Pendiente';
        }
        if ($status === self::APPRAISING) {
            return 'En valoración';
        }
        if ($status === self::NOT_APPLICABLE) {
            return 'No procede';
        }
        if ($status === self::IN_PROGRESS) {
            return 'En progreso';
        }
        if ($status === self::FINISHED) {
            return 'Terminada';
        }
        if ($status === self::RATED) {
            return 'Valorada';
        }
        return 'Desconocido';
    }

    public static function toArray()
    {
        return [
            self::PENDING => self::getName(self::PENDING),
            self::APPRAISING => self::getName(self::APPRAISING),
            self::NOT_APPLICABLE => self::getName(self::NOT_APPLICABLE),
            self::IN_PROGRESS => self::getName(self::IN_PROGRESS),
            self::FINISHED => self::getName(self::FINISHED),
            self::RATED => self::getName(self::RATED),
        ];
    }
}