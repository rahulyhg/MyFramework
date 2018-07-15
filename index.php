<?php
//define('ROOT',$_SERVER['SERVER_NAME']);
session_start();

// Підключаємо фунції
require_once 'components/function.php';

//Підключаємо клас автозагрузки
require_once 'components/autoload.php';

//Робим автозагрузку класів
$Autoload = new autoload();
$Autoload->autoload();


// Запускаємо посередники
$Middleware = new listMiddleware();
$Middleware->requireMiddleware();


//Піжключаєм ядро для знаходження роутів
$Route = new core();
$Route->run();

