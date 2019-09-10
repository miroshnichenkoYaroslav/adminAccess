<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-AdminCabinetController', function ($user) {
            if ($user->role->name === 'superadmin') {
                return true;
            }

            return $user->hasPermissionTo('view AdminCabinetController');
        });

        Gate::define('view-PageController', function ($user) {
            if ($user->role->name === 'superadmin') {
                return true;
            }

            return $user->hasPermissionTo('view PageController');
        });
    }
}
