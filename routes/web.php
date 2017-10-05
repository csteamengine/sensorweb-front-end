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

Route::get('fields', 'FieldController@fields')->name('fields');
Route::post('fields/add', 'FieldController@addField')->name('addField');
Route::get('fields/remove', 'FieldController@removeField')->name('removeField');

Route::get('homeNodes', 'NodeController@homeNodes')->name('homeNodes');
Route::post('homeNodes/add', 'NodeController@addHomeNode')->name('addHomeNode');
Route::get('homeNodes/remove', 'NodeController@removeHomeNode')->name('removeHomeNode');

Route::get('leafNodes', 'NodeController@leafNodes')->name('leafNodes');

Route::get('analysis', 'HomeController@analysis')->name('analysis');

Route::get('settings', 'HomeController@settings')->name('settings');

Route::get('userProfile', 'UserController@userProfile')->name('userProfile');


