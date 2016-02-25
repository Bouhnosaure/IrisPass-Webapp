<?php

use App\Events\Notification;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', 'PagesController@index');

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

    });

    //Organization
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/', array('uses' => 'SubscriptionController@index'));
        Route::get('create/{planid}', array('uses' => 'SubscriptionController@create'));
        Route::post('pay', array('uses' => 'SubscriptionController@initializeBilling'));

        Route::get('handle/webhook', array('uses' => 'SubscriptionController@handleWebhook'));
        Route::get('handle/redirect', array('uses' => 'SubscriptionController@handleRedirect'));
    });

    //Virtual Desktop
    Route::group(['prefix' => 'virtualdesktop'], function () {

        Route::get('/', array('uses' => 'VirtualDesktopController@index'));

        Route::get('users/create', array('uses' => 'OsjsUsersController@create'));
        Route::post('users', array('uses' => 'OsjsUsersController@store'));
        Route::get('users/{id}', array('uses' => 'OsjsUsersController@show'));
        Route::get('users/{id}/edit', array('uses' => 'OsjsUsersController@edit'));
        Route::patch('users/{id}/edit', array('uses' => 'OsjsUsersController@update'));
        Route::delete('users/{id}', array('uses' => 'OsjsUsersController@destroy'));

        Route::get('groups/create', array('uses' => 'OsjsGroupsController@create'));
        Route::post('groups', array('uses' => 'OsjsGroupsController@store'));
        Route::get('groups/{id}', array('uses' => 'OsjsGroupsController@show'));
        Route::get('groups/{id}/edit', array('uses' => 'OsjsGroupsController@edit'));
        Route::patch('groups/{id}/edit', array('uses' => 'OsjsGroupsController@update'));
        Route::delete('groups/{id}', array('uses' => 'OsjsGroupsController@destroy'));

        Route::post('manage/groups/{groupId}/add/{userId}', array('uses' => 'OsjsUserGroupsController@addUserToGroup'));
        Route::post('manage/groups/{groupId}/remove/{userId}', array('uses' => 'OsjsUserGroupsController@removeUserFromGroup'));

    });

    //Website
    Route::group(['prefix' => 'website'], function () {

        Route::get('/', array('uses' => 'WebsiteController@index'));
        Route::get('create', array('uses' => 'WebsiteController@create'));
        Route::post('create', array('uses' => 'WebsiteController@store'));
        Route::delete('delete', array('uses' => 'WebsiteController@destroy'));

    });


});
