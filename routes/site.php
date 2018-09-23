<?php


use Components\core\routes\Route;

Route::group(['path' => 'site','as' => 'site'],function (){



    Route::get('/', 'indexController@showMainPage')->name('index');

    Route::post('/','indexController@subscriptionMailing')->name('subscriptionMailing');

    Route::group(['path' => 'service'],function (){

        Route::get('change_currency/[0-9]','currencyController@changeCurrency/$2')->name('change_currency');

    });

    Route::group(['as' => 'basket','url' => 'basket'],function () {

        Route::get('/mini','basketController@showMiniCart');

    });

    Route::group(['as' => 'cat','url' => 'cat'],function (){

        Route::get('','catalogController@show');
        Route::get('/3','catalogController@show');

    });
});



