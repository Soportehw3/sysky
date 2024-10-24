<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Licencia;
use App\Notifications\LicenciaVencimientoNotification;
use Carbon\Carbon;

class EnviarRecordatoriosLicencias extends Command
{
    protected $signature = 'licencias:enviar-recordatorios';
    protected $description = 'Envía recordatorios de licencias basados en la fecha seleccionada';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $hoy = Carbon::today();
        $licencias = Licencia::where('fecha_recordatorio', $hoy)->get();

        foreach ($licencias as $licencia) {
            $usuario = $licencia->usuario;

            // Verifica si el usuario responsable existe
            if ($licencia->usuario) {
                $licencia->usuario->notify(new LicenciaVencimientoNotification($licencia));
                $this->info("Notificación enviada a: " . $usuario->email);
            } else {
                $this->error("No se encontró un usuario responsable para el préstamo ID: " . $licencia->id);

            }
        }

        $this->info('Recordatorios de licencias enviados.');
    }
}
