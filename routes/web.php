<?php



    Route::group(['path' => 'LOL'], function () {
        Route::rt('index', 'category.indexController@index');
        Route::rt('iqwdndex', 'category.indexController@index');
    });

Route::group(['path' => 'LOLw'], function () {
    Route::rt('indedsax', 'category.indexController@index');
    Route::rt('inded2sax', 'category.indexController@index');
    Route::rt('iqwdn1dex', 'category.indexController@index');
    Route::rt('iqwdndex', 'category.indexController@index');
});





