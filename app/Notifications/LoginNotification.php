<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('⚠️ Alerta de Seguridad - Inicio de Sesión')
        ->greeting('Hola, ' . $notifiable->nombre)
        ->line('Te informamos que se acaba de iniciar sesión en tu cuenta de MiniMarket.')
        ->line('Desde la dirección IP: ' . request()->ip())
        ->line('Fecha: ' . now()->format('d/m/Y H:i:s'))
        ->action('Si no fuiste tú, cambia tu clave aquí', url('/restablecer'))
        ->line('Si fuiste tú, puedes ignorar este correo.')
        ->thankYou('Atentamente, el equipo de MiniMarket.');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
