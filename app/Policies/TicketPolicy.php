<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tickets.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return bool
     */
    public function view(User $user, Ticket $ticket)
    {
        if ($user->es_admin) {
            return $user->condominios->contains($ticket->condominio_id);
        }
        if ($user->es_cliente) {
            return $ticket->cliente_id === $user->cliente->id;
        }
        if ($user->es_coordinador) {
            return $ticket->cat_id === $user->cat->id;
        }
        if ($user->es_contratista) {
            return $ticket->manpowers->contains('contratista_id', $user->contratista->id);
        }

        return false;
    }

    /**
     * Determine whether the user can create tickets.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->es_admin || $user->es_cliente;
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return bool
     */
    public function update(User $user, Ticket $ticket)
    {
        if ($user->es_admin) {
            return $user->condominios->contains($ticket->condominio_id);
        }
        return false;
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return bool
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->es_admin && $user->condominios->contains($ticket->condominio_id);
    }

    /**
     * Determine whether the user can restore the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return bool
     */
    public function restore(User $user, Ticket $ticket)
    {
        return $user->es_admin && $user->condominios->contains($ticket->condominio_id);
    }

    /**
     * Determine whether the user can permanently delete the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return bool
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        return $user->es_admin && $user->condominios->contains($ticket->condominio_id);
    }

    /**
     * Determine whether the user can asign a coordinator to the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return bool
     */
    public function asignarCat(User $user, Ticket $ticket)
    {
        return $user->es_admin && $user->condominios->contains($ticket->condominio_id);
    }

 
    public function contestarEncuesta(User $user, Ticket $ticket)
    {
        if (!$ticket->finalizado) {
            return false;
        }
        if ($user->es_admin) {
            return $user->condominios->contains($ticket->condominio_id);
        }
        if ($user->es_cliente) {
            return $ticket->cliente_id === $user->cliente->id;
        }
        return false;
    }

    public function finalizar(User $user, Ticket $ticket)
    {
        if (!$ticket->valorado) {
            return false;
        }
        if ($user->es_admin) {
            return $user->condominios->contains($ticket->condominio_id);
        }
        return false;
    }
}
