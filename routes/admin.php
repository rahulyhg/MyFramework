<?php

use Components\core\Route;

Route::group(['path' => 'admin','as' => 'admin','url' => 'admin'],function (){

    Route::get('', 'indexController@show')->name('index');

    Route::get('/main', 'mainController@show')->name('main');

    Route::post('/main', 'mainController@save')->name('mainPost');

});
