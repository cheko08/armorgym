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
    Route::post('miembros/destroy/{id}','MiembroController@destroy');

    Route::get('membresias','MembresiaController@index');
    Route::get('membresias/create','MembresiaController@create');
    Route::post('membresias/store','MembresiaController@store');
    Route::get('membresias/edit/{id}','MembresiaController@edit');
    Route::post('membresias/update/{id}','MembresiaController@update');
    Route::post('membresias/destroy/{id}','MembresiaController@destroy');

    Route::get('sucursales','SucursalController@index');
    Route::get('sucursales/create','SucursalController@create');
    Route::post('sucursales/store','SucursalController@store');
    Route::get('sucursales/edit/{id}','SucursalController@edit');
    Route::post('sucursales/update/{id}','SucursalController@update');
    Route::post('sucursales/destroy/{id}','SucursalController@destroy');
});
