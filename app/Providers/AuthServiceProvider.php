<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Ticket' => 'App\Policies\TicketPolicy',
        'App\Models\DetalleTicket' => 'App\Policies\DetalleTicketPolicy',
        'App\Models\Cliente' => 'App\Policies\ClientePolicy',
        'App\Models\Contratista' => 'App\Policies\ContratistaPolicy',
        'App\Models\Coordinador' => 'App\Policies\CoordinadorPolicy',
        'App\Models\Manpower' => 'App\Policies\ManpowerPolicy',
        'App\Models\Encuesta' => 'App\Policies\EncuestaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
