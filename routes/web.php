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
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/users/settings', 'UserSettingsController@edit');
Route::put('/users/settings', 'UserSettingsController@update');

/**
 * Image Uploader routes
 */
Route::get('/uploader', 'UploaderController@show')->name('uploader');
Route::get('/uploader/image/{name}', 'UploaderController@index')->name('showImage');
Route::put('/uploader', 'UploaderController@create')->name('createImage');