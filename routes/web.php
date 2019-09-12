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

//Auth
Auth::routes();

///USERS///////

Route::get('/users', 'UserController@user')->name('user')->middleware('auth');
Route::resource('user', 'UserController')->except(['create','show']);
Route::get('listuser', 'UserController@list')->name('listuser')->middleware('auth');

//HOME
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('institutional', 'InstitutionalController')->middleware('auth');
Route::get('institutional_dt', 'InstitutionalController@data_table')->middleware('auth');

Route::resource('zonas', 'ZonaController')->middleware('auth');
Route::get('zona_dt', 'ZonaController@data_table')->middleware('auth');

Route::resource('servicio', 'ServicioController')->middleware('auth');
Route::get('servicio_dt', 'ServicioController@data_table')->middleware('auth');

Route::resource('targeta_operaciones', 'OperationCardController')->middleware('auth');
Route::get('operacion_dt', 'OperationCardController@data_table')->middleware('auth');

Route::resource('bus', 'BusController')->middleware('auth');
Route::get('bus_dt', 'BusController@data_table')->middleware('auth');

/*Route::resource('auspice', 'AuspiceController')->middleware('auth');
Route::get('auspice_dt', 'AuspiceController@data_table')->middleware('auth');
Route::resource('presenter', 'PresenterController')->middleware('auth');
Route::get('presenter_dt', 'PresenterController@data_table')->middleware('auth');
Route::resource('aviso', 'AdvertisementController')->middleware('auth');
Route::get('aviso_dt', 'AdvertisementController@data_table')->middleware('auth');
Route::resource('programa', 'ProgramController')->middleware('auth');
Route::get('programa_dt', 'ProgramController@data_table')->middleware('auth');*/


Route::get('screem_institucional', 'APPController@institucional')->name('screem_institucional');
Route::get('screem_servicios', 'APPController@servicios')->name('screem_servicios');


