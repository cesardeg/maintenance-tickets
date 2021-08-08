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

    Route::put('manpowers/{manpower}/log', 'ManpowerController@registrarTrabajo')->name('manpowers.log');
    Route::delete('manpowers/{manpower}', 'ManpowerController@destroy')->name('manpowers.destroy');

    Route::resource('condominios', 'CondominioController');
    //Rutas de las encuestas
    Route::get('encuestas/{encuesta}', 'EncuestaController@show')->name('encuestas.show');
    Route::post('encuestas/{encuesta}', 'EncuestaController@store')->name('encuestas.contestar');

    //Rutas de las vistas de las estadisticas
    Route::get('estadistica-proyectos', 'EstadisticasController@vistaProyectos');
    Route::get('estadistica-contratista', 'EstadisticasController@vistaContratista');
    Route::get('estadistica-valoracion', 'EstadisticasController@vistaValoracion');
    Route::get('estadistica-solucion', 'EstadisticasController@vistaSolucion');
    Route::get('estadistica-satisfaccion', 'EstadisticasController@vistaSatisfaccion');

    Route::get('schedules/coordinador', 'ScheduleControler@coordinador')->name('schedules.coordinador');
    Route::get('schedules/contratista', 'ScheduleControler@contratista')->name('schedules.contratista');
});
//Rutas para actualizacion de un ticket
Route::post('tickets/{ticket}/asignarCat', 'TicketController@asignarCat')->name('tickets.add-cat');
Route::post('detallesTicket/{detalle}/valorar', 'DetalleTicketController@valorar')->name('detalles-ticket.valorar');
Route::post('detallesTicket/{detalle}/contratistas', 'DetalleTicketController@asignarContratista')->name('detalles-ticket.contratistas.store');
//Ruta para generar pdf del dictamen
Route::get('tickets/{ticket}/pdf', 'TicketController@genaratePDF')->name('tickets.showPDF');

//Rutas para obtener datos de las estadisticas
Route::get('estadistica-proyectos/getData', 'EstadisticasController@dataProyectos');
Route::get('estadistica-contratista/getData', 'EstadisticasController@dataContratista');
Route::get('estadistica-valoracion/getData', 'EstadisticasController@dataValoracion');
Route::get('estadistica-solucion/getData', 'EstadisticasController@dataSolucion');
Route::get('estadistica-satisfaccion/getData', 'EstadisticasController@dataSatisfaccion');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');