<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    //   dd('test');
        // Broadcast::routes(['middleware' => ['auth:api']]);
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}