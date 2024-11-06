<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
 protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            // Obtenez toutes les demandes de crédit avec le statut 'credit obtenu'
            $creditDemandes = CreditDemande::where('status', 'credit obtenu')->get();

            foreach ($creditDemandes as $creditDemande) {
                $creditSolde = ($creditDemande->solde*(0.04/12) )/(1- pow(1+(0.04/12), - ($creditDemande->duree_remboursement*12)));
                $compte = $creditDemande->compte;
                $compte->solde -= $creditSolde;
                $compte->save();
            }
        })->Monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
