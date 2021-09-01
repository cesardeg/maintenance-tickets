<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAgenda;

class Coordinador extends Model
{
    use HasAgenda;

    protected $table = 'cat';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['working_hours'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['agenda_cat', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agenda_cat()
    {
        return $this->belongsTo(AgendaCat::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'cat_id');
    }

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }

    public function getAgendaAttribute()
    {
        return $this->agenda_cat;
    }

    public function getProyectoAttribute($value)
    {
        return $this->condominio?->nombre ?? $value;
    }
}
