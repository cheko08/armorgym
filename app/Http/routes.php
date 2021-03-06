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
Route::get('inactive/miembros', 'MiembroController@inactive');
Route::auth();
Route::get('user/cambiar-password', 'UserController@cambiarPassword');
Route::post('user/changePassword/{id}', 'UserController@changePassword');
Route::get('user/register', 'UserController@register')->middleware('admin');
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@panelDeControl');
Route::post('buscar', 'HomeController@buscar');
Route::get('miembros/create','MiembroController@create');
Route::post('miembros/store','MiembroController@store');
Route::get('miembros/edit/{id}','MiembroController@edit');
Route::post('miembros/update/{id}','MiembroController@update');
Route::post('miembros/updateFoto/{id}','MiembroController@updateFoto');
Route::post('miembros/destroy/{id}','MiembroController@destroy');
Route::get('miembros/acceso', 'MiembroController@acceso');
Route::post('miembros/validar-acceso', 'MiembroController@validarAcceso');
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
Route::get('miembros/pagar/{id}','PagoController@pagar');
Route::post('pagos/pagar/{id}','PagoController@realizarPago');
Route::get('reportes', 'ReporteController@index');
Route::get('reportes/detalle', 'ReporteController@detalleVentas');
Route::post('reportes/generar', 'ReporteController@generar');
Route::get('reportes/ticket/{id}', 'ReporteController@ticket');
Route::get('reportes/reportes-corte/{id}', 'ReporteController@reporteCorte');
//ventas
Route::get('ventas/punto-venta', 'VentasController@puntoVenta');
Route::post('ventas/cobrar', 'VentasController@cobrar');
Route::get('ventas/ticket/{id}', 'VentasController@ticket');
Route::get('ventas/salidas', 'VentasController@getSalidas');
Route::post('ventas/salidas', 'VentasController@postSalidas');
//API VENTAS
Route::post('api/addProducto','VentasController@scan');
Route::get('productos/scan-producto', 'ProductoController@scanProducto');
Route::post('productos/store-codigo', 'ProductoController@storeCodigo');
Route::get('productos/store-producto/{id}', 'ProductoController@storeProducto');
Route::post('productos/store','ProductoController@storeProductoDetalles');
Route::get('productos', 'ProductoController@index');
Route::get('productos/edit/{id}', 'ProductoController@edit');
Route::post('productos/update/{id}', 'ProductoController@update');
//Inventarios
Route::get('inventarios/index', 'InventariosController@index');
Route::get('inventarios/create', 'InventariosController@create');
Route::post('inventarios/store', 'InventariosController@store');

Route::post('caja/abrir', 'VentasController@abrirCaja');
Route::get('caja/cerrar', 'VentasController@cerrarCaja');

});
Route::get('emails/bienvenido', function(){
return view('emails.bienvenido');
});