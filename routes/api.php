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


Route::get('list_tipos', 'API_TiposController@list');

Route::get('list_productos', 'API_ProductosController@list');
Route::get('list_productos_JSON', 'API_ProductosController@list_JSON');

//WEB APP
Route::get('herbalife', 'APPController@institucional');


Route::get('productos', 'API\ProductsController@list')->name('productos');

///API Authentication
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'API\Auth\AuthController@login')->name('login');
    Route::post('register', 'API\Auth\AuthController@register');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\Auth\AuthController@logout');
        Route::get('user', 'API\Auth\AuthController@user');
    });
});