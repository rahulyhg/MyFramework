<?php

session_start();

//composer autoloader
require_once 'vendor/autoload.php';

// Підключаємо функції
require_once 'components/core/function.php';

//Піжключаєм ядро для знаходження роутів

$route = new  Components\core\core();
$route->run();

