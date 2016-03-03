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


    //Users
    Route::group(['prefix' => 'management'], function () {

        Route::get('/', array('uses' => 'UsersManagementController@index'));

        Route::get('users/create', array('uses' => 'UsersController@create'));
        Route::post('users', array('uses' => 'UsersController@store'));
        Route::get('users/{id}', array('uses' => 'UsersController@show'));
        Route::get('users/{id}/edit', array('uses' => 'UsersController@edit'));
        Route::patch('users/{id}/edit', array('uses' => 'UsersController@update'));
        Route::delete('users/{id}', array('uses' => 'UsersController@destroy'));

        Route::get('groups/create', array('uses' => 'GroupsController@create'));
        Route::post('groups', array('uses' => 'GroupsController@store'));
        Route::get('groups/{id}', array('uses' => 'GroupsController@show'));
        Route::get('groups/{id}/edit', array('uses' => 'GroupsController@edit'));
        Route::patch('groups/{id}/edit', array('uses' => 'GroupsController@update'));
        Route::delete('groups/{id}', array('uses' => 'GroupsController@destroy'));

        Route::post('manage/groups/{groupId}/add/{userId}', array('uses' => 'UsersGroupsController@addUserToGroup'));
        Route::post('manage/groups/{groupId}/remove/{userId}', array('uses' => 'UsersGroupsController@removeUserFromGroup'));

    });

    //Website
    Route::group(['prefix' => 'website'], function () {

        Route::get('/', array('uses' => 'WebsiteController@index'));
        Route::get('create', array('uses' => 'WebsiteController@create'));
        Route::post('create', array('uses' => 'WebsiteController@store'));
        Route::delete('delete', array('uses' => 'WebsiteController@destroy'));

    });

    //CRM
    Route::group(['prefix' => 'crm'], function () {

        Route::get('/', array('uses' => 'CrmController@index'));
        Route::post('crm/activate/{id}', ['as' => 'crm.activate', 'uses' => 'CrmController@activateCRM']);
        Route::post('crm/create/user/{id}', ['as' => 'crm.activate', 'uses' => 'CrmController@createUser']);
        Route::post('crm/disable/{id}', ['as' => 'crm.activate', 'uses' => 'CrmController@disableCRM']);
        Route::post('crm/reactivate/{id}', ['as' => 'crm.activate', 'uses' => 'CrmController@reactivateCRM']);
        Route::get('crm/status/{id}', ['as' => 'crm.activate', 'uses' => 'CrmController@checkAvailabilityCRM']);
        Route::post('crm/users/{id}/toogle/{user}', ['as' => 'crm.activate', 'uses' => 'CrmController@toogleUserCRM']);
        Route::get('crm/users/{id}', ['as' => 'crm.activate', 'uses' => 'CrmController@getUsersCRM']);

    });


});
