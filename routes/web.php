<?php
use Components\core\Route;


Route::group(['path' => 'kek'],function (){
    Route::rt('/', 'indexController@index');
});




