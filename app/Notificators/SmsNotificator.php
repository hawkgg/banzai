<?php

namespace App\Notificators;

use App\Notificators\NotificatorInterface;
use App\Models\User;

class SmsNotificator implements NotificatorInterface
{
    /**
     * Отправка sms-сообщения. Проверки для простоты примера опустим.
     *
     * @param  \App\Models\User  $user
     * @param  string  $text
     *
     * @return void
     */
    public function send(User $user, string $text)
    {
        echo "<p>SMS \"$text\" успешно отправлено на номер $user->phone.</p>";
    }
}
