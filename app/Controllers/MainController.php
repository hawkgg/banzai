<?php

namespace App\Controllers;

use App\Services\NotificationService;
use App\Notificators\{EmailNotificator, SmsNotificator};
use App\Models\User;

class MainController {
    public function index()
    {
        // Типа фейкер
        $user1 = new User('user1@mail.ru', '5621723');
        $user2 = new User('user2@gmail.com', '624237325');

        $users = User::all();

        // Инициализация и конфигурация сервиса
        $service = new NotificationService();
        
        // Клиентский код с доступом к готовому
        // к работе объекту сервиса рассылки
        $text = 'Какой-то текст';

        foreach ($users as $user) {
            // Теперь, чтобы добавить новый вид уведомления, надо создать
            // нотификатор и добавить его сюда в параметры.
            $service->setNotificators(
                new EmailNotificator,
                new SmsNotificator
            );
            $service->notify($user, $text);
        }
    }

    public function err404()
    {
        echo '404';
    }
}
