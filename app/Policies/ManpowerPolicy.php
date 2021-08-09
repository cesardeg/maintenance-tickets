<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Manpower;

class ManpowerPolicy
{
    use HandlesAuthorization;

    public function registrarTrabajo(User $user, Manpower $manpower)
    {
        return $user->es_admin
            || ($manpower->contratista_id === $user->contratista?->id)
            || ($manpower->ticket !== null && $manpower->ticket->cat_id === $user->cat?->id);
    }

    public function delete(User $user, Manpower $manpower)
    {
        return $user->es_admin;
    }
}
