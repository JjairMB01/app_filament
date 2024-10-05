<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Vormkracht10\TwoFactorAuth\Notifications\SendOTP as NotificationsSendOTP;
use Illuminate\Notifications\Notification;

class SendOTP extends NotificationsSendOTP implements ShouldQueue
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
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hola!')
            ->line('Tu código de autenticación es: ' . $this->getTwoFactorCode($notifiable))
            ->action('Verificar código', url('/')) // Cambia la URL si es necesario
            ->line('Este código es válido por 10 minutos.')
            ->salutation('Saludos!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array // Cambiado a $notifiable y tipo de parámetro
    {
        return [
            //
        ];
    }
}
