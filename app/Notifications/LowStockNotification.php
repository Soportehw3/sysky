<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LowStockNotification extends Notification
{
    use Queueable;

    protected $accesorio;

    public function __construct($accesorio)
    {
        $this->accesorio = $accesorio;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Alerta de Bajo Stock de Accesorio')
            ->line('El accesorio ' . $this->accesorio->descripcion . ' tiene un stock bajo.')
            ->line('Cantidad actual: ' . $this->accesorio->cantidad)
            ->action('Ver Accesorio', url('/accesorios/' . $this->accesorio->id))
            ->line('Por favor, tome las medidas necesarias.');
            }

    public function toArray($notifiable)
    {
        return [
            'accesorio_id' => $this->accesorio->id,
            'message' => 'El accesorio ' . $this->accesorio->descripcion . ' tiene una cantidad baja.'
        ];
    }
}
