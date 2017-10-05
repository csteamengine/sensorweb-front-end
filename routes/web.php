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
    return view('index');
})->middleware('auth');

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('fields', 'HomeController@fields')->name('fields');

Route::get('homeNodes', 'HomeController@homeNodes')->name('homeNodes');

Route::get('leafNodes', 'HomeController@leafNodes')->name('leafNodes');

Route::get('analysis', 'HomeController@analysis')->name('analysis');

Route::get('settings', 'HomeController@settings')->name('settings');

Route::get('userProfile', 'UserController@userProfile')->name('userProfile');


