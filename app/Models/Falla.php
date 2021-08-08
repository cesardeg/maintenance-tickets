<?php

namespace App\Models;
use App\Models\Familia;

use Illuminate\Database\Eloquent\Model;

class Falla extends Model
{
    protected $table = 'fallas';

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
}
