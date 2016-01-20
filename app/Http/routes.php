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


    Route::get('images/{dir}/{img}', function ($dir, $img) {
        // serve an image with cache !
        // determine a lifetime and return as object instead of string
        $photo = Image::cache(function ($image) use ($dir, $img) {
            return $image->make(storage_path() . '/app/images/' . $dir . '/' . $img);
        }, 1, false);

        return Response::make($photo, 200, array('Content-Type' => 'image/jpeg'));

    });

});
