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

//Ruta para el menu principal de los Usuarios //Cambiar a resource para mandar los datos de las notificaciones
Route::get('/Menu', function(){
	return view('Layouts.menu_principal');
});

Route::resource('Usuario','Usuario');

//Rutas para el modulo de la Correspondencia Enviada
Route::resource('Enviada','nuevo_documento_e');


//Rutas para el modulo de la Correspondencia Recibida
Route::resource('Recibida','nuevo_documento_r');
Route::resource('Seguimiento','seguimiento_r');
Route::resource('Reparto','reparto_r');
Route::resource('Acciones','acciones_r');
Route::resource('Buscar_Documento','buscar_documento');
Route::resource('Buscar_Documento_a','buscar_documento_a');
Route::resource('Busqueda_Documentos','busqueda_documentos');

//Ruta para borrar cache
Route::get('/clear-cache', function() {
         Artisan::call('cache:clear');
       return "Cache is cleared";
     });

Auth::routes();

//Ruta para el inicio
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
