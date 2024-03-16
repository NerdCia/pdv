<?php

namespace App\Providers;


// use Illuminate\Support\Facades\Gate;
use App\Models\RoleUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('all', function(User $user) {
            return $user->id == RoleUser::find(1)->user_id;
        });

        Gate::define('products', function(User $user) {
            return $user->id == RoleUser::find(2)->user_id;
        });

        Gate::define('sales', function(User $user) {
            return $user->id == RoleUser::find(3)->user_id;
        });
    }
}
