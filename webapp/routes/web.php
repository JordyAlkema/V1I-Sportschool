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

        Route::get('/app/my-account', 'UserController@profileView')->name('dashboard.account');

        Route::get('/app/activity', 'DashboardController@activitiesView')->name('dashboard.activity');

        Route::get('/app/transacties', 'DashboardController@transactionsView')->name('dashboard.transactions');

        Route::get('/app/my-card', 'DashboardController@gymCardView')->name('dashboard.card');

        Route::get('/app/transactie/{id}', 'DashboardController@activityTransaction')->name('dashboard.transaction');

        Route::get('/app/coach', 'DashboardController@personalCoachView')->name('dashboard.personalCoach');

        Route::get('/app/locations', 'DashboardController@locationsView')->name('dashboard.locations');

        /**
         * Actions
         */

        Route::get('/app/addBalance/{add}', 'BalanceController@addBalance')->name('action.addBalance');
        Route::post('/app/sendMessage', 'PersonalCoachController@sendMessage')->name('action.sendMessage');





    });
