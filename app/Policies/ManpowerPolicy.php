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
        if ($user->es_admin) {
            return true;
        }
        if ($user->es_coordinador) {
            return $manpower->ticket->cat_id === $user->cat?->id;
        }
        if ($user->es_contratista) {
            return !$manpower->finalizado && $manpower->contratista_id === $user->contratista?->id;
        }
        return false;
    }

    public function delete(User $user, Manpower $manpower)
    {
        return $user->es_admin;
    }
}
