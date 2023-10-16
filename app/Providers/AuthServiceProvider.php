<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\Maintenance\Maintenance;
use App\Models\User\User;
use App\Policies\BiomedicalEquipment\BiomedicalEquipmentPolicy;
use App\Policies\Maintenance\MaintenancePolicy;
use App\Policies\User\UserPolicy;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        BiomedicalEquipment::class => BiomedicalEquipmentPolicy::class,
        Maintenance::class => MaintenancePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //superAdministrador
        Gate::before(function ($user, $ability) {
            return $user->hasRole(RolesSeeder::ROOT) ? true : null;
        });

        
    }
}
