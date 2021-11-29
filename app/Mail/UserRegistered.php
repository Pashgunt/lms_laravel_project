<?php

namespace App\Mail;

use App\LMS\Repositories\UsersTemporary;
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

    public function __construct(UsersTemporary $user)
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
