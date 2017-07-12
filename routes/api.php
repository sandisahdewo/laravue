<?php

use Illuminate\Http\Request;

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::prefix('master')->group(function() {
	Route::namespace('Master')->group(function() {
		Route::get('items/get', 'ItemsController@get')->name('api.master.items.get');
		Route::get('items/find/{id}', 'ItemsController@find')->name('api.master.items.find');
		Route::post('items/update/{id}', 'ItemsController@update')->name('api.master.items.update');
	});
});
