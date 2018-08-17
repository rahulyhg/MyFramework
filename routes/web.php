<?php
use Components\core\Route;


Route::group(['as' => 'i','middleware' => 'kek'],function (){
Route::group(['as' => 'kek'],function (){
    Route::get('lol', 'kek.indexController@index')->name('omj');
    Route::post('lol', 'kek.indexController@post')->name('lol');
});

    Route::get('lol0', 'kek.indexController@index')->name('omj');
    Route::post('lol7', 'kek.indexController@post')->name('lol');
});
