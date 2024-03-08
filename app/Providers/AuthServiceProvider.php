<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Esta funcion antepone todos los permisos, y entonces ese rol tiene acceso a todo 
        //sin importar si despues se le niega el acceso a algo
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('programador')) {
                return true;
            }
        });

        

        //
    }
}
