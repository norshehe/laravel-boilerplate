<?php

namespace App\Providers;

use App\Models\CrmEntityModel;
use App\Observers\CRMEntityObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // CrmEntityModel::observe(CRMEntityObserver::class);

    }
}
