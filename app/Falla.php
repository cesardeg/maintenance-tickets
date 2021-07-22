<?php

namespace App;
use App\Familia;

use Illuminate\Database\Eloquent\Model;

class Falla extends Model
{
    protected $table = 'fallas';

    public function familia() {
        return $this->belongsTo('App\Familia');
    }
}
