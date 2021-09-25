<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Cliente;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationships
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'user_id', 'id');
    }

    public function cat()
    {
        return $this->hasOne(Coordinador::class, 'user_id', 'id');
    }

    public function contratista()
    {
        return $this->hasOne(Contratista::class, 'user_id', 'id');
    }

    public function condominios()
    {
        return $this->belongsToMany(Condominio::class, 'user_condominio');
    }

    public function getEsClienteAttribute()
    {
        return $this->type === 'cliente' && $this->cliente !== null;
    }

    public function getEsCoordinadorAttribute()
    {
        return $this->type === 'coordinador' && $this->cat !== null;
    }

    public function getEsContratistaAttribute()
    {
        return $this->type === 'contratista' && $this->contratista !== null;
    }

    public function getEsAdminAttribute()
    {
        return $this->type === 'user';
    }
}
