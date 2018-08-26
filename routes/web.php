<?php


use Components\core\Route;


Route::get('/', 'indexController@showMainPage')->name('index');

Route::get('change_currency/[0-9]','currencyController@changeCurrency/$2')->name('change_currency');
