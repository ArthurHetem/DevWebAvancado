<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/password/reset/'.$this->token.'?email='.$this->email);
        return (new MailMessage)
            ->subject("Redefinição de senha")
            ->greeting("Olá, {$this->name}")
            ->line("Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.")
            ->action("Redefinir a senha", $url)
            ->line("Este link de redefiniçao de senha expira em :count minutos.", ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
            ->line("Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.")
            ->salutation("Ate breve");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
