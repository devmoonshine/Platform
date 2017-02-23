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

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();

    $user->updatePermissions('edit posts');

    return new \Illuminate\Http\Response('hello', 200);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/users/settings', 'UserSettingsController@edit');
Route::put('/users/settings', 'UserSettingsController@update');
