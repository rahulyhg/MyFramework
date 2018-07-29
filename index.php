<?php

session_start();

// Підключаємо функції
require_once 'components/core/function.php';

//Підключаємо клас автозагрузки
require_once 'components/core/autoload.php';

//Робим автозагрузку класів
autoload::autoload_class();


//Піжключаєм ядро для знаходження роутів
$route = new core();
$route->run();

