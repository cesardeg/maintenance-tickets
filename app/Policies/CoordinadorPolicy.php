<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Coordinador;
use App\Models\User;

class CoordinadorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any coordinadors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can view the coordinador.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinador  $coordinador
     * @return mixed
     */
    public function view(User $user, Coordinador $coordinador)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can create coordinadors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can update the coordinador.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinador  $coordinador
     * @return mixed
     */
    public function update(User $user, Coordinador $coordinador)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can delete the coordinador.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinador  $coordinador
     * @return mixed
     */
    public function delete(User $user, Coordinador $coordinador)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can restore the coordinador.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinador  $coordinador
     * @return mixed
     */
    public function restore(User $user, Coordinador $coordinador)
    {
        return $user->es_admin;
    }

    /**
     * Determine whether the user can permanently delete the coordinador.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinador  $coordinador
     * @return mixed
     */
    public function forceDelete(User $user, Coordinador $coordinador)
    {
        return $user->es_admin;
    }
}
