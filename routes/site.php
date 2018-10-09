<?php


use Components\core\routes\Route;

Route::group(['path' => 'site','as' => 'site'],function (){

    Route::get('/', 'indexController@showMainPage')->name('index');

    Route::post('/','indexController@subscriptionMailing')->name('subscriptionMailing');

    Route::get('change_currency/[0-9]','currencyController@changeCurrency')->name('change_currency');

    Route::group(['as' => 'basket','url' => 'basket'],function () {

        Route::get('/mini','basketController@showMiniCart');

    });

    Route::group(['as' => 'cat','url' => 'cat','path' => 'catalog'],function (){

        Route::get('','catalogController@show')->name('index');
        Route::get('=[0-9]+','catalogController@show');

        Route::get('(=[0-9]+)*/sort=[a-z]+','catalogController@filter')->name('filter');
        Route::get('(=[0-9]+)*/from=([0-9]+)end=[0-9]+','catalogController@filter');

        Route::get('/changeShowList/[a-z]+','changeShowListController@changeShowList')->name('changeList');
        Route::get('/changeView/[0-9]+','changeShowListController@changeView')->name('changeView');

        Route::post('(=[0-9]+)*/filterPrice','changeShowListController@filterPrice')->name('filterPrice');

    });
});



