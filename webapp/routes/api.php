<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user', 'ApiController@user')->name('api.User');

Route::get('checkIn', 'DashboardController@homeView')->name('api.CheckIn');
Route::get('checkOut', 'DashboardController@homeView')->name('api.CheckOut');
