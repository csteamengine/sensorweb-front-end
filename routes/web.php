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

Route::get('/', 'Auth\LoginController@index')->name('index');

Route::get('home', 'HomeController@home')->name('home');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('homeNodes', 'NodeController@homeNodes')->name('homeNodes');
Route::post('homeNodes/add', 'NodeController@addHomeNode')->name('addHomeNode');
Route::get('homeNodes/remove/{id}', 'NodeController@removeHomeNode')->name('removeHomeNode');
Route::get('homeNodes/{id}', 'NodeController@getHomeNode')->name('getHomenode');
Route::get('homeNodes/edit/{id}', 'NodeController@editHomeNode')->name('editHomenode');
Route::post('homeNodes/update', 'NodeController@updateHomenode')->name('updateHomenode');

Route::get('leafNodes', 'NodeController@leafNodes')->name('leafNodes');
Route::get('leafNodes/{id}', 'NodeController@getLeafnodeData')->name('getLeafnodeData');
Route::get('readings/remove/{id}', 'NodeController@removeReading')->name('removeReading');

Route::get('analysis', 'HomeController@analysis')->name('analysis');

Route::get('settings', 'HomeController@settings')->name('settings');

Route::get('userProfile', 'UserController@userProfile')->name('userProfile');
Route::post('updateUser', 'UserController@updateUser')->name('updateUser');


