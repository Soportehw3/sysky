<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Prestamo;

class PrestamoEntregaNotification extends Notification
{
    use Queueable;

    protected $prestamo;

    public function __construct(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
         // Verificar si tipoEquipo y marca están disponibles para evitar errores de acceso a propiedades nulas
         $tipoEquipoNombre = $this->prestamo->equipo->tipoEquipo ? $this->prestamo->equipo->tipoEquipo->nombre : 'Sin Tipo';
         $marcaNombre = $this->prestamo->equipo->marca ? $this->prestamo->equipo->marca->nombre : 'Sin Marca';
 
         return (new MailMessage)
             ->subject('Recordatorio de entrega de equipo')
             ->line('Este es un recordatorio de que el equipo prestado debe ser entregado hoy.')
             ->line('Detalles del préstamo:')
             ->line('Empleado: ' . $this->prestamo->empleado->nombre . ' ' . $this->prestamo->empleado->apellidoP . ' ' . $this->prestamo->empleado->apellidoM)
             ->line('Equipo: ' . $tipoEquipoNombre . ' de la marca ' . $marcaNombre . ' con etiqueta ' . $this->prestamo->equipo->etiqueta_skytex)
             ->line('Fecha de Préstamo: ' . $this->prestamo->fecha_prestamo)
             ->line('Fecha de Regreso: ' . $this->prestamo->fecha_regreso)
             ->action('Ver Préstamo', url('/prestamos/' . $this->prestamo->id))
             ->line('Gracias.');
    }

    public function toArray($notifiable)
    {
        return [
            'prestamo_id' => $this->prestamo->id,
            'fecha_regreso' => $this->prestamo->fecha_regreso,
        ];
    }
}
