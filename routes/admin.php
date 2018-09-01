<?php

use Components\core\Route;

Route::group(['path' => 'admin','as' => 'admin','url' => 'admin'],function (){

    Route::get('', 'adminIndexController@show')->name('index');

    Route::group(['as' => 'main','url' => '/main'],function () {

        Route::get('', 'adminMainController@show')->name('main');
        Route::post('', 'adminMainController@save')->name('mainPost');

        Route::get('/aboutSite', 'adminMainController@aboutSite')->name('aboutSite');
        Route::post('/aboutSite', 'adminMainController@saveAboutSite')->name('aboutSitePost');

        Route::get('/sliders', 'adminMainController@sliderBottom')->name('slider');
        Route::post('/sliders', 'adminMainController@saveSettignsSliderBottom')->name('sliderPost');
    });


});
