<?php
Route::get('/','HomeController@index');
Route::post('login','HomeController@login');
Route::get('logout','HomeController@logout');
Route::match(array('get','post'),'sendemail','EmailController@sendemail');
Route::match(array('get','post'),'testreset','EmailController@test');
Route::get('forgotpassword','HomeController@forgotpassword');
Route::group(['middleware' => ['auth']],function(){
    Route::group(['prefix' => 'admin'],function(){
        Route::get('dashboard', 'HomeController@dashboard');
        Route::get('logout','HomeController@logout');
        Route::post('insertuser', 'HomeController@insertuser');
        Route::post('submitcompany','AdminController@submitcompany');
        Route::post('getcompanydata','AdminController@getcompanydata');
        Route::match(array('get','post'),'users','AdminController@users');
        Route::post('changepass','AdminController@changepass');
        Route::post('getuserdata','AdminController@getuserdata');
        Route::post('submitfilter','AdminController@submitfilter');
        Route::post('deleteuser','AdminController@deleteuser');
        Route::post('sendKeyword','AdminController@sendKeyword');

        Route::match(array('get','post'),'expenses','AdminController@expenses');
        Route::match(array('get','post'),'getExpenses','AdminController@getExpenses');
        Route::match(array('get','post'),'submitExpenses','AdminController@submitExpenses');
        Route::match(array('get','post'),'reportExpenses','AdminController@reportExpenses');
    });
});