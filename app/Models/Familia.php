<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'familias';

    public function conceptos()
    {
        return $this->belongsToMany(Concepto::class);
    }

    public function fallas()
    {
        return $this->belongsToMany(Falla::class);
    }
}
