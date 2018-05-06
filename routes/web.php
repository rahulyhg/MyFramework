<?php

Route::rt('trrtrt', 'category.indexController@index');
Route::rt('ttrt', 'category.indexController@index');

    Route::group(['path' => 'LOL'], function () {
       Route::rt('index', 'category.indexController@index');
        Route::rt('i2dex', 'category.indexController@index');
});


Route::rt('kk', 'category.indexController@index');
Route::rt('ww', 'category.indexController@index');


Route::group(['path' => 'LFASOL'], function () {
    Route::rt('index', 'category.indexController@index');
    Route::rt('i2dex', 'category.indexController@index');
});
Route::rt('tt', 'category.indexController@index');