<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'clientes';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function cliente() {
        return $this->hasOne('App\Cliente');
    }

    public function condominio() {
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
}
