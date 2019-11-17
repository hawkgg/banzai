<?php

namespace App\Models;

use System\Model;

class User extends Model {
    /**
     * Массив экземпляров класса.
     *
     * @var \App\Models\User[]
     */
    protected static $instances;

    /**
     * Создание экземпляра и добавление его в общий массив.
     *
     * Для простоты примера предположим, что у юзеров только такие поля.
     *
     * @param  string  $email
     * @param  string  $phone
     *
     * @return void
     */
    public function __construct(string $email, string $phone)
    {
        $this->email = $email;
        $this->phone = $phone;
        self::$instances[] = $this;
    }
}
