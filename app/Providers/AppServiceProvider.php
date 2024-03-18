<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Configuration;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $logo = Configuration::where('key', '=', 'logo')->first()->value;
        $company_name = Configuration::where('key', '=', 'company_name')->first()->value;

        view()->share([
            'company_name' => $company_name,
            'logo' => $logo
        ]);

        Paginator::useBootstrapFive();
    }
}
