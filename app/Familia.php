<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'familias';

    public function conceptos() {
        return $this->belongsToMany('App\Concepto');
    }

    public function fallas() {
        return $this->belongsToMany('App\Falla');
    }
}
