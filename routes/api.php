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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('master')->group(function() {
	Route::namespace('Master')->group(function() {
		Route::get('items/get', 'ItemsController@get')->name('api.master.items.get');
		Route::get('items/find/{id}', 'ItemsController@find')->name('api.master.items.find');
		Route::post('items/update/{id}', 'ItemsController@update')->name('api.master.items.update');
	});
});
