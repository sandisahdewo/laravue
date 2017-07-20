<?php

use Illuminate\Http\Request;

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::middleware('jwt.refresh')->group(function() {
	Route::post('/logout', 'AuthController@logout');
});

Route::prefix('master')->group(function() {
	Route::middleware('jwt.auth')->group(function() {
		Route::namespace('Master')->group(function() {
			Route::prefix('item')->group(function() {
				Route::post('create', 'ItemController@create')->name('api.master.item.create');
				Route::get('get', 'ItemController@get')->name('api.master.item.get');
				Route::get('find/{id}', 'ItemController@find')->name('api.master.item.find');
				Route::post('update/{id}', 'ItemController@update')->name('api.master.item.update');
				Route::post('delete', 'ItemController@delete')->name('api.master.item.delete');
			});

			Route::prefix('category')->group(function() {
				Route::post('create', 'CategoryController@create')->name('master.category.create');
				Route::get('get', 'CategoryController@get')->name('master.category');
				Route::get('find/{id}', 'CategoryController@find')->name('master.category.find');
				Route::post('update/{id}', 'CategoryController@update')->name('master.category.update');
				Route::delete('delete/{id}', 'CategoryController@delete')->name('master.category.delete');
			});
		});
	});
});

Route::get('count-unread-notification', 'NotificationController@countUnreadNotification')->name('count.unread.notification');
Route::get('get-unread-notification', 'NotificationController@getUnreadNotification')->name('get.unread.notification');
Route::get('get-all-notification', 'NotificationController@getAllNotification')->name('get.all.notification');
Route::get('mark-read-notification/{id}', 'NotificationController@markAsReadNotification')->name('mark.read.notification');