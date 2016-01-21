<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@index');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'DashboardController@index');

    //User Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', array('uses' => 'ProfileController@index'));
        Route::get('edit', array('uses' => 'ProfileController@edit'));
        Route::patch('edit', array('uses' => 'ProfileController@update'));
    });

    //Confirmations
    Route::group(['prefix' => 'confirmation'], function () {
        Route::get('/', array('uses' => 'Auth\ConfirmationController@index'));
        Route::get('send/{type}', array('uses' => 'Auth\ConfirmationController@send'));
        Route::get('phone', array('uses' => 'Auth\ConfirmationController@submitPhoneCode'));
        Route::post('phone', array('uses' => 'Auth\ConfirmationController@handlePhoneCode'));
        Route::get('mail/{code}', array('uses' => 'Auth\ConfirmationController@confirmMailCode'));
    });

    //Organization
    Route::group(['prefix' => 'organization'], function () {
        Route::get('/', array('uses' => 'OrganizationController@index'));
        Route::get('/create', array('uses' => 'OrganizationController@create'));
        Route::post('/', array('uses' => 'OrganizationController@store'));
        Route::get('edit', array('uses' => 'OrganizationController@edit'));
        Route::patch('edit', array('uses' => 'OrganizationController@update'));

        Route::get('/subscriptions', array('uses' => 'OrganizationController@subscriptions'));

    });

});
