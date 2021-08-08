<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
}
