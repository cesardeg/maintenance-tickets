<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table = 'cat';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function agenda_cat() {
        return $this->belongsTo('App\AgendaCat');
    }
}
