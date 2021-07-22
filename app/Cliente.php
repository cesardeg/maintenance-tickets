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
        return $this->belongsTo('App\Condominio');
    }
}
