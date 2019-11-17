<?php 

namespace App\Services;

use App\Notificators\{NotificatorInterface, EmailNotificator, SmsNotificator};
use App\Models\User;

class NotificationService
{
    /**
     * Массив нотификаторов.
     * 
     * @var \App\Notificators\NotificatorInterface[]
     */
    private $notificators = [];

    /**
     * Установка нотификаторов.
     *
     * @param  NotificatorInterface[]  $notificators
     *
     * @return void
     */
    public function setNotificators(NotificatorInterface ...$notificators)
    {
        $this->notificators = $notificators;
    }

    /**
     * Запуск отправок через каждый заранее установленный нотификатор.
     *
     * @param  User  $user
     * @param  string  $text
     *
     * @return void
     */
    public function notify(User $user, string $text)
    {
        foreach ($this->notificators as $notificator) {
            $notificator->send($user, $text);
        }
    }
}
