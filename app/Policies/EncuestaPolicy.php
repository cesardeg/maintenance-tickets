<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Encuesta;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncuestaPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Encuesta $encuesta)
    {
        return ($encuesta->ticket?->finalizado || $encuesta->ticket?->rated)  && (
                $user->es_admin || 
                ($user->es_cliente && $encuesta->ticket?->cliente_id == $user->cliente->id)
            );
    }

    public function contestar(User $user, Encuesta $encuesta)
    {
        return $encuesta->ticket?->finalizado && $encuesta->active == '0' && (
            $user->es_admin || 
            ($user->es_cliente && $encuesta->ticket?->cliente_id == $user->cliente->id)
        );
    }
}
