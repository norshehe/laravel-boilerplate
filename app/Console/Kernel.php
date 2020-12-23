<?php

namespace App\Console;

use App\Http\Controllers\Api\Crons\ImapInboxController;
use App\Http\Controllers\Api\Crons\LicenseReminderController;
use App\Http\Controllers\Api\Crons\NOCMaintenanceController;
use App\Http\Controllers\Api\Crons\ProductStockReminderController;
use App\Http\Controllers\api\crons\ResolvedTicketController;
use App\Http\Controllers\api\crons\SLAManagerController;
use App\Http\Controllers\Api\Crons\ViolatedTicketsController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\ProductQuantityCron;
use App\Mail\AssetCronMail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function scheduleTimezone()
    {
        return 'Asia/Singapore';
    }

    protected function schedule(Schedule $schedule)
    {

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
