<?php

namespace System;

final class Router
{
    /**
     * Массив с маршрутами и их обработчиками.
     *
     * @var array
     */
    private static $routes = array();
   
    /*
     * Запрет на создание экземпляров.
     */
    private function __construct() {}
      
    /**
     * Добавление маршрутов в виде [регулярка => обработчик].
     *
     * @param  string  $pattern
     * @param  string  $callback
     *
     * @return void
     */
    public static function route($pattern, $callback)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $callback;
    }
   
    /**
     * Определение маршрута.
     * 
     * Перебор всех ранее объявленных маршрутов и, в случае
     * успеха, запуск обработчика.
     *
     * @param  string  $url
     *
     * @return void
     */
    public static function execute($url)
    {
        foreach (self::$routes as $pattern => $callback) {
            if (preg_match($pattern, $url, $params)) { 
                [$controller, $action] = explode("@", $callback);
                call_user_func_array(
                    "\App\Controllers\\$controller::$action",
                    array_values($params)
                );

                return;
            }
        }
    }
}
