<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

/**
 * Отправка письма для восстановления пароля
 *
 * Генерация токена
 */
class ResetPassword extends Notification
{
    public string $token;
    public static $createUrlCallback;
    public static $toMailCallback;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = $this->resetUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token, $resetUrl);
        }

        return $this->buildMailMessage($resetUrl);
    }

    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Восстановления пароля'))
            ->line(Lang::get('Для сброса пароля перейдите по ссылке ниже'))
            ->action(Lang::get('Сбросить пароль'), $url)
            ->line(
                Lang::get(
                    'Ссылка на восстановление пароля действительна в течении :count минут.',
                    ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]
                )
            );
    }

    protected function resetUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(
            route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)
        );
    }

    public static function createUrlUsing($callback): void
    {
        static::$createUrlCallback = $callback;
    }

    public static function toMailUsing($callback): void
    {
        static::$toMailCallback = $callback;
    }
}
