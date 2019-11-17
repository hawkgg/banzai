<?php

namespace System;

abstract class Model
{
    /**
     * Массив с экземплярами текущего класса.
     *
     * @var array
     */
    protected static $instances;

    /**
     * Возврат массива всех записей, работу с базой опустим :)
     *
     * @return array
     */
    public static function all()
    {
        return static::$instances;
    }
}
