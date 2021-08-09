<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'familias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    public function conceptos()
    {
        return $this->belongsToMany(Concepto::class);
    }

    public function fallas()
    {
        return $this->belongsToMany(Falla::class);
    }
}
