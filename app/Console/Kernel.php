<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('prestamos:notificar')->dailyAt('17:32');
        // Programa la sincronización para que se ejecute cada ho
        $schedule->command('sync:empleados')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        
    }
    protected $commands = [
        Commands\SyncEmpleados::class,
    ];
}
