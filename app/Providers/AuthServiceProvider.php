<?php

namespace App\Providers;


// use Illuminate\Support\Facades\Gate;
use App\Models\RoleUser;
use App\Models\Role;
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

        Gate::define('all', function (User $user) {
            $user = User::find($user->id);
            foreach ($user->roles as $role) {
                if ($role->name == 'todos') {
                    return true;
                } else {
                    return false;
                }
            }
        });

        Gate::define('products', function (User $user) {
            $user = User::find($user->id);
            foreach ($user->roles as $role) {
                if ($role->name == 'produtos' || $role->name == 'todos') {
                    return true;
                } else {
                    return false;
                }
            }
        });

        Gate::define('sales', function (User $user) {
            $user = User::find($user->id);
            foreach ($user->roles as $role) {
                if ($role->name == 'vendas' || $role->name == 'todos') {
                    return true;
                } else {
                    return false;
                }
            }
        });
    }
}
