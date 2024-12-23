<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
{
    // Exécuter une commande artisan tous les jours à minuit
    $schedule->command('my:custom-command')->daily();

    // Nettoyer les fichiers temporaires chaque semaine
    $schedule->call(function () {
        // Votre logique ici
    })->weekly();

    // Exécuter une tâche chaque heure
    $schedule->command('inspire')->hourly();
}


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
