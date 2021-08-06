<?php

namespace App\Policies;

use App\DetalleTicket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetalleTicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the detalle ticket.
     *
     * @param  \App\User  $user
     * @param  \App\DetalleTicket  $detalleTicket
     * @return mixed
     */
    public function valorar(User $user, DetalleTicket $detalle)
    {
        $ticket = $detalle->ticket;
        return !!$ticket->coordinador && ($user->es_admin || $user->id == $ticket->coordinador->user_id);
    }

    /**
     * Determine whether the user can update the detalle ticket.
     *
     * @param  \App\User  $user
     * @param  \App\DetalleTicket  $detalleTicket
     * @return mixed
     */
    public function asignarContratista(User $user, DetalleTicket $detalle)
    {
        return $this->valorar($user, $detalle) && $detalle->valoracion == 'Si';
    }
}
