<?php
use Components\core\Route;


//Route::post('kek/([0-9]+)', 'indexController@index/$2');
//$2 - бо [0-9] на другій позиції

Route::any('kek/([0-9]+)', 'indexController@index/$2');




