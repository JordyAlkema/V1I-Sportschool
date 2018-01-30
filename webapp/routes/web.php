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
    return \Illuminate\Support\Facades\Auth::user()->abonnement;
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
    Route::group(['middleware' => ['AuthGebruiker'], 'prefix' => '/app/'], function () {

        Route::get('/', 'DashboardController@homeView')->name('dashboard');

        Route::get('/my-account', 'UserController@profileView')->name('dashboard.account');

        Route::get('/activity', 'DashboardController@activitiesView')->name('dashboard.activity');

        Route::get('/transacties', 'DashboardController@transactionsView')->name('dashboard.transactions');

        Route::get('/my-card', 'DashboardController@gymCardView')->name('dashboard.card');

        Route::get('/transactie/{id}', 'DashboardController@activityTransaction')->name('dashboard.transaction');

        Route::get('/coach', 'DashboardController@personalCoachView')->name('dashboard.personalCoach');

        Route::get('/locations', 'DashboardController@locationsView')->name('dashboard.locations');

        /**
         * Actions
         */

        Route::get('/addBalance/{add}', 'BalanceController@addBalance')->name('action.addBalance');
        Route::get('/BuyAbonnement/{id}', 'BalanceController@BuyAbonnement')->name('action.BuyAbonnement');
        Route::post('/sendMessage', 'PersonalCoachController@sendMessage')->name('action.sendMessage');
        Route::post('/saveProfile', 'UserController@profileUpdate')->name('action.saveUser');
    });

    Route::group(['middleware' => ['AuthMedewerker'], 'prefix' => '/app/medewerker/'], function () {

        Route::get('/', 'DashboardController@homeViewMedewerker')->name('medewerker.dashboard');

        Route::get('/my-account', 'UserController@profileViewMedewerker')->name('medewerker.dashboard.account');

        Route::get('/gebruikers', 'DashboardController@gebruikersViewMedewerker')->name('medewerker.gebruikers');
        Route::get('/gebruiker/{id}', 'DashboardController@gebruikerViewMedewerker')->name('medewerker.gebruiker');

        Route::post('/saveProfile/{id}', 'UserController@profileUpdateMedewerker')->name('medewerker.action.saveUser');
    });
