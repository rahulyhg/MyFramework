<?php

session_start();

//error_reporting(0);


//composer autoloader
require_once 'vendor/autoload.php';


/**
 * Загальні налаштування сайту
*/

\Components\siteSettings::creatSettings();


/**
 * Опред мову, робимо переадресацію
*/

\Components\extension\localization\siteLang::lang();


(new  Components\core\core())->run();







//////Вивести товари з категорії
//SELECT `t`.*,`n`.`name` as `category`,`n`.`id_cat` FROM `langs_bridge` `b` LEFT JOIN `tovars` `t` On `t`.`lid` = `b`.`id` LEFT JOIN `tovar_categories` `cat_t` ON `cat_t`.`lid_tovar` = `t`.`lid`
//
// join (SELECT `c`.`name`,`cat_t`.`lid_tovar`,`cat_t`.`Id_categor` as `id_cat` FROM `category` `c`   join `tovar_categories` `cat_t` On `c`.`lid` = `cat_t`.`Id_categor` WHERE `lang_id` = 2 and `visible` = 1) as `n` ON  `t`.`lid` = `n`.`lid_tovar`
//
//WHERE `id_lang` = 2 GROUP BY `lid`8


//nl2br