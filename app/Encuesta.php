<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }
}
