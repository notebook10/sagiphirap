<?php
Route::get('/','HomeController@index');
Route::post('login','HomeController@login');
Route::get('logout','HomeController@logout');
Route::match(array('get','post'),'reset','EmailController@send');
Route::match(array('get','post'),'testreset','EmailController@test');

Route::group(['middleware' => ['auth']],function(){
    Route::group(['prefix' => 'admin'],function(){
        Route::get('dashboard', 'HomeController@dashboard');
        Route::get('logout','HomeController@logout');
        Route::post('insertuser', 'HomeController@insertuser');
        Route::post('submitcompany','AdminController@submitcompany');
        Route::post('getcompanydata','AdminController@getcompanydata');
    });
});

