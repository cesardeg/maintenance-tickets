<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any clientes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can view the cliente.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return mixed
     */
    public function view(User $user, Cliente $cliente)
    {
        return $user->es_admin && $user->condominios->contains($cliente->condominio_id);
    }

    /**
     * Determine whether the user can create clientes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can update the cliente.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return mixed
     */
    public function update(User $user, Cliente $cliente)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can delete the cliente.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return mixed
     */
    public function delete(User $user, Cliente $cliente)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can restore the cliente.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return mixed
     */
    public function restore(User $user, Cliente $cliente)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can permanently delete the cliente.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return mixed
     */
    public function forceDelete(User $user, Cliente $cliente)
    {
        return $user->es_admin;
    }
}
