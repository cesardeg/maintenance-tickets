<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
    //
    protected $table = 'contratistas';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function agenda_tc() {
        return $this->belongsTo('App\AgendaTc');
    }

    public function agenda_cat() {
        return $this->belongsTo('App\AgendaCat');
    }
}
