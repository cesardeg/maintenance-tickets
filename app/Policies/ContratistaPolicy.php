<?php

namespace App\Policies;

use App\Models\Contratista;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContratistaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any contratistas.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can view the contratista.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contratista  $contratista
     * @return mixed
     */
    public function view(User $user, Contratista $contratista)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can create contratistas.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can update the contratista.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contratista  $contratista
     * @return mixed
     */
    public function update(User $user, Contratista $contratista)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can delete the contratista.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contratista  $contratista
     * @return mixed
     */
    public function delete(User $user, Contratista $contratista)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can restore the contratista.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contratista  $contratista
     * @return mixed
     */
    public function restore(User $user, Contratista $contratista)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can permanently delete the contratista.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contratista  $contratista
     * @return mixed
     */
    public function forceDelete(User $user, Contratista $contratista)
    {
        return $user->es_admin;
    }
}
