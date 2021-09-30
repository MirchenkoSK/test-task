<?php

use App\Components\Router;

// Отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Старт сессии
session_start();

// Подключение автозагрузчика
require __DIR__.'/vendor/autoload.php';

// Инициализация роутера
$router = new Router();
$router->run();