<?php

namespace App\Notificators;

use App\Notificators\NotificatorInterface;
use App\Models\User;

class EmailNotificator implements NotificatorInterface
{
    /**
     * Отправка email-сообщения. Проверки для простоты примера опустим.
     *
     * @param  \App\Models\User  $user
     * @param  string  $text
     *
     * @return void
     */
    public function send(User $user, string $text)
    {
        echo "<p>Email \"$text\" успешно отправлен на почту $user->email.</p>";
    }
}
