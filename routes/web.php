<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');

Route::post('clientes/getClientes', 'ClienteController@getClientes');

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('clientes', 'ClienteController');
    Route::resource('contratistas', 'ContratistaController');
    Route::resource('cat', 'CoordinadorController');

    Route::resource('tickets', 'TicketController');

    Route::resource('condominios', 'CondominioController');
    //Rutas de las encuestas
    Route::get('encuesta/{id}', 'EncuestaController@show');
    Route::post('encuesta/{id}', 'EncuestaController@store');

    //Rutas de las vistas de las estadisticas
    Route::get('estadistica-proyectos', 'EstadisticasController@vistaProyectos');
    Route::get('estadistica-contratista', 'EstadisticasController@vistaContratista');
    Route::get('estadistica-valoracion', 'EstadisticasController@vistaValoracion');
    Route::get('estadistica-solucion', 'EstadisticasController@vistaSolucion');
    Route::get('estadistica-satisfaccion', 'EstadisticasController@vistaSatisfaccion');
});
//Rutas para actualizacion de un ticket
Route::delete('tickets/{ticket}', 'TicketController@destroy');
Route::post('tickets/getTicketValues', 'TicketController@getTicketValues');
Route::post('tickets/setCat', 'TicketController@asignarCat');
Route::post('tickets/setCita', 'TicketController@asignarCita');
Route::post('tickets/setCitaAtencion', 'TicketController@asignarCitaAtencion');
Route::post('tickets/setFechaReporte', 'TicketController@asignarFechaReporte');
Route::post('tickets/setPrototipo', 'TicketController@asignarPrototipo');
//Rutas para actualizacion de los detalles de un ticket
/* Route::get('detallesTicket/status/{ticket_id}', 'DetalleTicketController@checkStatus'); */
Route::post('detallesTicket/detalle', 'DetalleTicketController@detalle');
Route::post('detallesTicket/changeValoracion', 'DetalleTicketController@cambiarValoracion');
Route::post('detallesTicket/changeEstado', 'DetalleTicketController@cambiarEstado');
Route::post('detallesTicket/setCont', 'DetalleTicketController@asignarContratista');
Route::post('detallesTicket/setObservacion', 'DetalleTicketController@asignarObservacion');
Route::post('detallesTicket/setUbicacion', 'DetalleTicketController@asignarUbicacion');
Route::post('detallesTicket/cambiarCliente', 'DetalleTicketController@cambiarCliente');
//Ruta para generar pdf del dictamen
Route::get('generarDictamen/{id}', 'TicketController@genaratePDF');
//Rutas para obtener datos de las estadisticas
Route::get('estadistica-proyectos/getData', 'EstadisticasController@dataProyectos');
Route::get('estadistica-contratista/getData', 'EstadisticasController@dataContratista');
Route::get('estadistica-valoracion/getData', 'EstadisticasController@dataValoracion');
Route::get('estadistica-solucion/getData', 'EstadisticasController@dataSolucion');
Route::get('estadistica-satisfaccion/getData', 'EstadisticasController@dataSatisfaccion');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');