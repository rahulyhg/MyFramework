<?php

use Components\core\routes\Route;

Route::group(['path' => 'admin','as' => 'admin','url' => 'admin'],function (){

    Route::get('', 'adminIndexController@show')->name('index');

    Route::group(['as' => 'main','url' => '/main','path' => 'main'],function () {

        Route::get('', 'adminMainController@show')->name('main');
        Route::post('', 'adminMainController@save')->name('mainPost');

        Route::get('/aboutSite', 'adminMainController@aboutSite')->name('aboutSite');
        Route::post('/aboutSite', 'adminMainController@saveAboutSite')->name('aboutSitePost');

        Route::get('/sliders', 'adminSLiderController@sliderPage')->name('slider');
        Route::post('/sliders', 'adminSLiderController@saveSettignsSlider')->name('sliderPost');
        Route::get('/sliders-delete/[0-9]+', 'adminSLiderController@deleteSettignsSlider')->name('deleteSlider');



    });


});
