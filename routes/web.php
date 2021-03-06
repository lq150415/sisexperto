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



Route::get( 'login',  ['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login',  ['as' => '/login','uses' => 'Auth\LoginController@login']);
Route::get('/logout',  ['as' => '/logout','uses' => 'Auth\LoginController@logout']);
Route::get('logouttemp',['as' => 'logouttemp','uses' => 'AccessController@logout']);

Auth::routes();
/*
*Route middleware all users
*/
Route::name('register.user')->post('registrar/usuario','UserController@registrar');
  Route::group(['middleware' => 'auth'], function (){
    //Custom routes
    Route::name('paciente.actualizar')->post('paciente/actualizar','PacienteController@actualizar');
    Route::name('paciente.eliminar')->post('paciente/eliminar','PacienteController@eliminar');

    Route::name('reservapaciente.store')->post('reserva/storepac','ReservasController@storepac');
    Route::name('reserva.eliminar')->post('reserva/eliminar','ReservasController@eliminar');
    Route::name('reserva.actualizar')->post('reserva/actualizar','ReservasController@actualizar');

    Route::get('diagnostico/{id}','DiagnosticoController@diagnostico');
    Route::post('diagnostico/getDiagnostico','DiagnosticoController@motor_inferencia');
    Route::get('diagnosticos/cancelar/{id}','DiagnosticoController@cancelar');
    Route::get('diagnostico/detalles/{id}','DiagnosticoController@detalles');
    Route::post('diagnostico/detalles/getConsulta','DiagnosticoController@consulta');
    Route::get('diagnostico/reporte/{id}','ReporteController@tratamiento');

    Route::name('reporte.general')->get('reporte/general','ReporteController@general');
    Route::name('reporte.mensual')->get('reporte/mensual','ReporteController@mensual');
    Route::name('reporte.diario')->get('reporte/diario','ReporteController@diario');
    Route::name('reporte.paciente')->post('reporte/paciente','ReporteController@paciente');
    Route::name('reporte.rango')->post('reporte/rango','ReporteController@rango');

    Route::get('historial/pacientes/{id}','HistorialController@historial');
    //Custom middleware
    Route::resource('/','HomeController');
    Route::resource('paciente','PacienteController');
    Route::resource('diagnostico','DiagnosticoController');
    Route::resource('historial','HistorialController');
    Route::resource('reporte','ReporteController');
    Route::resource('reservas','ReservasController');

  });
