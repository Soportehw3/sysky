<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LicenciaVencimientoNotification extends Notification
{
    protected $licencia;

    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($licencia)
    {
        $this->licencia = $licencia;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
{
    $mailMessage = new MailMessage;
    $mailMessage->subject('Recordatorio de Licencia, Servicio o Suscripción');

    if ($this->licencia->fecha_siguiente_pago < now()) {
        $mailMessage->line('¡Atención! Tu licencia, servicio o suscripción ha expirado.');
    } else {
        $mailMessage->line('Te recordamos que tu licencia, servicio o suscripción está por expirar.');
    }

    $mailMessage->line('Detalles:')
        ->line('Nombre: ' . $this->licencia->nombre)
        ->line('Tipo: ' . $this->licencia->tipoLicencia->nombre)
        ->line('Fecha de Adquisición: ' . $this->licencia->fecha_adquisicion)
        ->line('Fecha del siguiente pago: ' . $this->licencia->fecha_siguiente_pago)
        ->line('Observaciones: ' . $this->licencia->observaciones)
        ->action('Ver Licencia', url('/licencias/' . $this->licencia->id))
        ->line('Gracias por usar nuestro sistema.');

    return $mailMessage;
}


    public function toArray($notifiable)
    {
        return [
            'licencia_id' => $this->licencia->id,
            'fecha_siguiente_pago' => $this->licencia->fecha_siguiente_pago,
        ];
    }
}
