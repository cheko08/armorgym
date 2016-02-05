<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@panelDeControl');

    Route::get('miembros/create','MiembroController@create');
    Route::post('miembros/store','MiembroController@store');
    Route::get('miembros/edit/{id}','MiembroController@edit');
    Route::post('miembros/update/{id}','MiembroController@update');
});
