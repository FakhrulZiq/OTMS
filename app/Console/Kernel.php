<?php

namespace App\Console;

use App\Console\Commands\GenerateInvoices;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('invoices:generate')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $routeMiddleware = [
        // Other middleware entries...
        'parent.auth' => \App\Http\Middleware\ParentAuthentication::class,
    ];

    protected $commands = [
        \App\Console\Commands\GenerateInvoices::class,
    ];
    
    
}
