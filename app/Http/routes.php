<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
        /*
         * Unprotected routes
         */
        $api->get('/', 'HomeController@index');

        $api->post('auth/signup', 'JwtController@signup');
        $api->post('auth/signin', 'JwtController@signin');
        $api->post('auth/refresh', 'JwtController@refresh');

        /*
         * Routes protected by JWT
         */
        $api->group(['middleware' => ['api.auth'], 'providers' => ['jwt'], 'protected' => true], function ($api) {

            $api->get('test/secure', 'HomeController@secureTest');
            //ToDo

        });
    });
});