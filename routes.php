<?php

use System\Router;

// Объявление маршрутов
Router::route('/', 'MainController@index');

Router::route('(.*)', 'MainController@err404');

// Запуск маршрутизатора
Router::execute($_SERVER['REQUEST_URI']);
