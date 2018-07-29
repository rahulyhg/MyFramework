<?php
Route::group(['path' => 'admin','cntrl'=>'admin'],function (){

    Route::rt('kek/([0-9]+)','IndexController@lel');

});

