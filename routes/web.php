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
			
		});
	});
	Route::get('count-unread-notification', 'NotificationController@countUnreadNotification')->name('count.unread.notification');
	Route::get('get-unread-notification', 'NotificationController@getUnreadNotification')->name('get.unread.notification');
	Route::get('get-all-notification', 'NotificationController@getAllNotification')->name('get.all.notification');
	Route::get('mark-read-notification/{id}', 'NotificationController@markAsReadNotification')->name('mark.read.notification');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
