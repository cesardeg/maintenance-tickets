<?php

namespace App\Policies;

use App\Models\DetalleTicket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetalleTicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the detalle ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DetalleTicket  $detalleTicket
     * @return mixed
     */
    public function view(User $user, DetalleTicket $detalle)
    {
        $ticket = $detalle->ticket;
    
        return $user->es_admin || (
            !!$ticket?->coordinador && (
                   $ticket->cat_id === $user->cat?->id
                || $ticket->cliente_id === $user->cliente?->id
                || $ticket->manpowers->contains(fn($m) => $m->contratista_id === $user->contratista?->id)
            )
        );
    }

    /**
     * Determine whether the user can update the detalle ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DetalleTicket  $detalleTicket
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
     * @param  \App\Models\User  $user
     * @param  \App\Models\DetalleTicket  $detalleTicket
     * @return mixed
     */
    public function asignarContratista(User $user, DetalleTicket $detalle)
    {
        return $this->valorar($user, $detalle) && $detalle->accepted_valoration;
    }
}
