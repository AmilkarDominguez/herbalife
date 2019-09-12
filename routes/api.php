<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('brand', 'CatalogueController@index');

//Agregamos nuestra ruta al controller

//CUSTOM



Route::get('list_advertisement', 'API_AdvertisementController@list');
Route::get('list_advertisement_JSON', 'API_AdvertisementController@list_JSON');

Route::get('list_auspice', 'API_AuspiceController@list');
Route::get('list_auspice_JSON', 'API_AuspiceController@list_JSON');

Route::get('list_institutional', 'API_InstitutionalController@list');
Route::get('list_institutional_JSON', 'API_InstitutionalController@list_JSON');

Route::get('list_presenter', 'API_PresenterController@list');
Route::get('list_presenter_JSON', 'API_PresenterController@list_JSON');

Route::get('list_program', 'API_ProgramController@list');
Route::get('list_program_JSON', 'API_ProgramController@list_JSON');


Route::get('list_tarjeta', 'API_TarjetaOperacionController@list');
Route::get('list_servicios', 'API_ServiciosController@list');

//WEB APP
Route::get('terminal', 'APPController@institucional');