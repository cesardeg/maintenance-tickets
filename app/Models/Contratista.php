<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAgenda;

class Contratista extends Model
{
    use HasAgenda;

    protected $table = 'contratistas';

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
    protected $hidden = ['agenda_tc', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agenda_tc()
    {
        return $this->belongsTo(AgendaTc::class);
    }

    public function getAgendaAttribute()
    {
        return $this->agenda_tc;
    }
}
