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
    return view('auth.login');
});

//Auth
Auth::routes();

///USERS///////

Route::get('/users', 'UserController@user')->name('user')->middleware('auth');
Route::resource('user', 'UserController')->except(['create', 'show']);
Route::get('listuser', 'UserController@list')->name('listuser')->middleware('auth');

///USER ADMIN///
Route::resource('users_admin', 'UserAdminController')->middleware('auth');
Route::get('users_dt', 'UserAdminController@data_table')->middleware('auth');



//HOME
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('institutional', 'InstitutionalController')->middleware('auth');
Route::get('institutional_dt', 'InstitutionalController@data_table')->middleware('auth');

Route::resource('tipos', 'TipoController')->middleware('auth');
Route::get('tipo_dt', 'TipoController@data_table')->middleware('auth');

Route::resource('dietas', 'DietaController')->middleware('auth');
Route::get('dieta_dt', 'DietaController@data_table')->middleware('auth');

Route::resource('productos', 'ProductoController')->middleware('auth');
Route::get('producto_dt', 'ProductoController@data_table')->middleware('auth');
Route::get('list_types', 'ProductoController@list')->middleware('auth');

Route::resource('ordenes', 'OrdenController')->middleware('auth');
Route::get('orden_dt', 'OrdenController@data_table')->middleware('auth');


Route::resource('rutinas', 'RutinaController')->middleware('auth');
Route::get('rutina_dt', 'RutinaController@data_table')->middleware('auth');
Route::get('crear_rutina', 'RutinaController@create_routine')->name('crear_rutina')->middleware('auth');
Route::get('dt_products', 'RutinaController@dt_products')->name('dt_products')->middleware('auth');
Route::post('save_detail', 'RutinaController@save_detail')->name('save_detail')->middleware('auth');
Route::get('dt_details', 'RutinaController@dt_details')->name('dt_details')->middleware('auth');

Route::resource('planes', 'PlanController')->middleware('auth');
Route::get('planes_dt', 'PlanController@data_table')->middleware('auth');
Route::get('list_clients', 'PlanController@list_clients')->middleware('auth');
Route::get('list_routines', 'PlanController@list_routines')->middleware('auth');

Route::post('save_ejecutions', 'PlanController@save_ejecutions')->middleware('auth');


Route::get('screem_institucional', 'APPController@institucional')->name('screem_institucional');
Route::get('screem_productos', 'APPController@productos')->name('screem_productos');

Route::resource('client', 'ClientController')->middleware('auth');
Route::get('client_dt', 'ClientController@data_table')->middleware('auth');

Route::resource('ejecuciones', 'EjecutionController')->middleware('auth');
Route::get('list_ejecutions', 'EjecutionController@data_table')->middleware('auth')->name('list_ejecutions');;
