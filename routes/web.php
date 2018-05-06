<?php


    Route::group(['path' => 'LOL'], function () {
       Route::rt('index', 'category.indexController@index');
        Route::rt('i2dex', 'category.indexController@index');
});





Route::group(['path' => 'LFASOL'], function () {
    Route::rt('index', 'category.indexController@index');
    Route::rt('i2dex', 'category.indexController@index');
});
Route::rt('ind12ex', 'category.indexController@index');