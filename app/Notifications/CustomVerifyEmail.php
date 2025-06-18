<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomVerifyEmail extends Notification
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
    public function toMail(object $notifiable): MailMessage
    {
        $verifyUrl = url('/verify-email?email=' . urlencode($notifiable->email));

        return (new MailMessage)
        ->subject('Confirma tu correo electrónico')
        ->greeting('¡Hola ' . $notifiable->name . ' 👋!')
        ->line('Gracias por registrarte en SGPM Club. Por favor confirma tu correo.')
        ->action('Verificar correo', $verifyUrl)
        ->line('Si no fuiste tú, no tienes que hacer nada.')
        ->salutation('Saludos cordiales del equipo de SGPM 🌟');
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
