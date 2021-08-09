<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $casts = [
        'fecha_escrituracion' => 'date',
        'fecha_poliza' => 'date',
        'fecha_entrega' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }

    public function scopeBuscar($qry, $text = '')
    {
        $needle = '%' . escape_like($text) . '%';
        return $qry->where(fn ($subQry) => 
            $subQry->orWhere('clientes.nombre', 'LIKE',  $needle)
                ->orWhere('clientes.numero_cliente', 'LIKE',  $needle)
                ->orWhere('clientes.desarrollador', 'LIKE',  $needle)
                ->orWhere('clientes.telefono', 'LIKE',  $needle)
                ->orWhereHas('condominio', fn($has) => $has->where('condominios.nombre', 'LIKE',  $needle))
                ->orWhereHas('user', fn($has) => $has->where('users.email', 'LIKE',  $needle))
        );
    }

    public function getCorreoAttribute()
    {
        return $this->user?->email;
    }
}
