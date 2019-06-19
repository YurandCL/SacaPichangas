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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@postBuscar');

Route::get('/principal', 'HomeController@vistaUsuario');
//Indicams primero la ruta, luego nombre del controlador y por ultimo la funcion.
Route::get('/buscar/{id}', 'BuscarController@index');
Route::get('/buscar2', 'BuscarController@buscar');
Route::post('/buscar', 'BuscarController@store');

Route::get('/pagar', 'PagarController@index');


Route::get('/adminstrador', 'AdministradorController@index');

//------------------------------------------------------------------------------------------
//--------------------- Vista de Edicion del perfil ----------------------------------------
//------------------------------------------------------------------------------------------
Route::get('/editar-perfil', 'UsuarioController@getEditarPerfil');
Route::post('/editar-perfil', 'UsuarioController@postEditarPerfil');
//------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------
//--------------------- Vista de reservas y contactanos ---------------------------------
//---------------------------------------------------------------------------------------
Route::post('/reservar', 'ReservasController@index');
//------------------------------------------------------------------------------------------
Route::post('/reservar-cancha', 'ReservasController@postReservarCancha');
//------------------------------------------------------------------------------------------
Route::get('/mis-reservas', 'ReservasController@getVerReservasCanchas');
//------------------------------------------------------------------------------------------
Route::get('/reservas', 'ReservasController@getVerMisReservasCanchas');
//------------------------------------------------------------------------------------------
Route::get('/contactanos', 'ContactanosController@index');


//------------------------------------------------------------------------------------------
//--------------------- Vista de canchas del administrador ---------------------------------
//------------------------------------------------------------------------------------------

Route::get('/canchas', 'CanchasController@index');
//------------------------------------------------------------------------------------------
Route::get('/crear-cancha', 'CanchasController@getCrearCancha');
Route::post('/crear-cancha', 'CanchasController@postCrearCancha');
//------------------------------------------------------------------------------------------
Route::get('/informacion-cancha', 'CanchasController@getInformacionCancha');
//------------------------------------------------------------------------------------------
Route::post('/informacion-local', 'InformacionController@postInformacionLocal');
//------------------------------------------------------------------------------------------
Route::get('/editar-cancha', 'CanchasController@getEditarCancha');
Route::post('/editar-cancha', 'CanchasController@postEditarCancha');
//------------------------------------------------------------------------------------------
Route::post('/eliminar-cancha/', 'CanchasController@postEliminarCancha');

//---------------------------------------------------------------------------------------
//-----------------------Vista de local del Administrador--------------------------------
//---------------------------------------------------------------------------------------

Route::get('/crear-local', 'LocalController@getCrearLocal');
Route::post('/crear-local', 'LocalController@postCrearLocal');
//------------------------------------------------------------------------------------------
Route::get('/editar-local', 'LocalController@getEditarLocal');
Route::post('/editar-local', 'LocalController@postEditarLocal');
//------------------------------------------------------------------------------------------
Route::post('/eliminar-local', 'LocalController@postEliminarLocal');

//------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------

Route::get('/adminstrador', 'AdministradorController@index');

Route::get('/contactanos', 'ContactanosController@index');
