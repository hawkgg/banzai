<?php

// Композер для слабых
spl_autoload_register (function ($className) {
    // Обработка абсолютного/относительного пути
    if ($className[0] == '\\') {
        require_once(realpath(__DIR__ . lcfirst($className) . ".php"));
    } else {
        require_once(realpath(__DIR__ . '\\' . lcfirst($className) . ".php"));
    }
});
