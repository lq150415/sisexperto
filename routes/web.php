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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
*Route middleware all users
*/
  Route::group(['middleware' => 'auth'], function (){
    //Custom middleware
    Route::name('register.user')->post('registrar/usuario','UserController@registrar');



  });
