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

Route::get('user/{user}/addresses', 'UserAddressesController@show')->name('user.address.show');
Route::post('user/{user}/address', 'UserAddressesController@store')->name('user.address.store');

Route::get('/', 'IndexController@index')->name('index');
