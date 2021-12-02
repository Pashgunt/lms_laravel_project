<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Модель для подтверждения почты при регистрации
 */
class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Отравление письма на почту с подтверждением регистрации
     */
    public function build(): UserRegistered
    {
        return $this->from('lms.laravel@gmail.com')
            ->view('confirm');
    }
}
