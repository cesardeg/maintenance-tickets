<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';

    public function familia() {
        return $this->belongsTo('App\Familia');
    }
}
