<?php

namespace App\Infraestructure\Console;

use App\Application\NotifyDebts\DebtsNotifier;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(DebtsNotifier::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(app_path('/Presentation/Console/Commands'));

        require base_path('routes/console.php');
    }
}
