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
    return \Illuminate\Support\Facades\Auth::user();
});

    /**
     * Login
     */
    Route::get('/login', 'AuthController@loginView')->name('loginView');
    Route::post('/login', 'AuthController@login')->name('login');

    /**
     * logout
     */
    Route::get('/logout', 'AuthController@logout')->name('logout');

    /**
     * Dashboard
     */
    Route::group(['middleware' => ['AuthGebruiker']], function () {

        Route::get('/app/', 'DashboardController@homeView')->name('dashboard');

        Route::get('/app/my-account', 'DashboardController@homeView')->name('dashboard.account');

        Route::get('/app/activity', 'DashboardController@homeView')->name('dashboard.activity');

        Route::get('/app/my-card', 'DashboardController@homeView')->name('dashboard.card');

    });