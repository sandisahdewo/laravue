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
    return view('master.category.index');
});
// Route::middleware('auth')->group(function() {
	Route::prefix('master')->group(function() {
		Route::namespace('Master')->group(function() {
			Route::get('items', 'ItemsController@index')->name('master.items');
			Route::post('items', 'ItemsController@create')->name('master.items.create');
			Route::get('items/find/{id}', 'ItemsController@find')->name('master.items.find');
			Route::post('items/delete', 'ItemsController@delete')->name('api.master.items.delete');

			Route::get('categories', 'CategoriesController@get')->name('master.categories');
			Route::get('categories/find/{id}', 'CategoriesController@find')->name('master.categories.find');
			Route::post('categories', 'CategoriesController@create')->name('master.categories.create');
			Route::post('categories/update/{id}', 'CategoriesController@update')->name('master.categories.update');
			Route::get('categories/delete/{id}', 'CategoriesController@delete')->name('master.categories.delete');
		});
	});
	Route::get('count-unread-notification', 'NotificationController@countUnreadNotification')->name('count.unread.notification');
	Route::get('get-unread-notification', 'NotificationController@getUnreadNotification')->name('get.unread.notification');
	Route::get('get-all-notification', 'NotificationController@getAllNotification')->name('get.all.notification');
	Route::get('mark-read-notification/{id}', 'NotificationController@markAsReadNotification')->name('mark.read.notification');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
