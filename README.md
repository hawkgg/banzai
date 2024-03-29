# Тестовое задание на вакансию PHP backend разработчик
![](https://hsto.org/getpro/habr/avatars/8f1/042/064/8f104206479a1cda45284c1167e45592.png)

## **Условие**
Есть сервис для отправки уведомлений:
```php
class NotificationService
{
    public function notify(User $user, $text)
    {
        $emailNotificator = new EmailNotificator();
        $smsNotificator = new SmsNotificator();
        $emailNotificator->sendEmail($user->email, $text);
        $smsNotificator>sendSms($user->phone, $text);
    }
}

class EmailNotificator
{
    public function sendEmail($email, $text)
    { ... }
}

class SmsNotificator
{
    public function sendSms($phone, $text)
    { ... }
}
```

Этот сервис сконфигурирован и отдан в клиентский код для выполнения рассылки:
```php
// Инициализация и конфигурация сервиса
$service = new NotificationService();

// Клиентский код с доступом к готовому к работе объекту сервиса рассылки
$text = 'Какой-то текст';
foreach ($users as $user) {
    $service->notify($user, $text);
}
```

## Ответы на вопросы
* Какие принципы SOLID нарушены в проектировании сервиса отправки уведомлений? 
  * Open Closed Principle / Принцип Открытости/Закрытости. Чтобы добавить новые способы нотификаций, надо *изменить* метод, который в клиентском коде уже используется.
  * Dependency Inversion Principle / Принцип Инверсии Зависимостей. Класс ```NotificationService``` зависит от ```EmailNotificator``` и ```SmsNotificator```.


* Какие паттерны проектирования можно использовать, чтобы сделать сервис более гибким и способным к легкому расширению способов рассылки?
    * Bridge / Мост. Этот паттерн позволит разделить "абстракцию" (```NotificationService```) и "реализацию" (```EmailNotificator```, ```SmsNotificator``` и др.), что поспособствует облегчению читаемости и масштабируемости кода.
    * Dependency Injection / Внедрение Зависимостей. Данный паттерн используется при реализации первого, он поможет освободить класс ```NotificationService``` от явных зависимостей. Это значит, что можно будет легко менять способы нотификации, а также проводить тестирование данного класса, как отдельной единицы.


* Какие еще проблемы есть в этом коде?
  * Синтаксическая ошибка при обращении к методу ```sendSms```.
  * Классы ```EmailNotificator``` и ```SmsNotificator``` по сути разными способами делают одно и то же, используя при этом разные наименования методов.
  * Метод ```notify``` использует сразу все доступные методы отправки, но может быть ситуация, когда понадобится только один из них.
  * Почти нигде не используется type hinting, что может стать следствием неочевидных ошибок.


## Что сделано
Был проведен рефакторинг сервиса для обеспечения возможности добавления третьего способа отправки уведомления, например WebPushNotificator. Клиентский код размещен в контроллере.

Основные изменения:
- Добавлен интерфейс для нотификаторов. Все они должны реализовывать метод ```send```, который первым аргументом принимает экземпляр класса ```User```, а вторым - текст сообщения.
- В соответствии с паттерном Мост, способы отправки уведомлений задаются методом ```setNotificators``` извне.