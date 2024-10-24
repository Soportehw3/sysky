<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Prestamo;
use App\Notifications\PrestamoEntregaNotification;
use Carbon\Carbon;

class NotificarPrestamos extends Command
{
    protected $signature = 'prestamos:notificar';
    protected $description = 'Notifica a los usuarios responsables sobre la fecha de entrega de los préstamos.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $hoy = Carbon::today();
        $prestamos = Prestamo::where('fecha_regreso', $hoy)->get();

        foreach ($prestamos as $prestamo) {
            $usuario = $prestamo->usuario;
            if ($usuario) {
                $usuario->notify(new PrestamoEntregaNotification($prestamo));
                $this->info("Notificación enviada a: " . $usuario->email);
            } else {
                $this->error("No se encontró un usuario responsable para el préstamo ID: " . $prestamo->id);
            }
        }

        $this->info('Notificaciones de préstamos enviadas correctamente.');
    }
}

