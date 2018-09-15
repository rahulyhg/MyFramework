<?php


use Components\core\routes\Route;

Route::group(['path' => 'site','as' => 'site'],function (){

    Route::get('change_currency/[0-9]','currencyController@changeCurrency/$2')->name('change_currency');

    Route::get('/', 'indexController@showMainPage')->name('index');

    Route::post('/','indexController@subscriptionMailing')->name('subscriptionMailing');
});



