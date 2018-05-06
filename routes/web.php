<?php






    Route::group(['path' => 'www'], function () {
        Route::rt('index', 'category.indexController@index');
        Route::rt('i2dex', 'category.indexController@index');
    });
    Route::group(['path' => 'jjj'], function () {
        Route::rt('index', 'category.indexController@index');
        Route::rt('i2dex', 'category.indexController@index');
    });


Route::rt('index', 'category.indexController@index');