<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conceptos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
}
