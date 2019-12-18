<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$apiVersion = 'v1';

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([ 'prefix' => 'api' ], function () use ($router, $apiVersion) {

    $router->group([ 'prefix' => $apiVersion ], function () use ($router) {

        $router->group([ 'prefix' => 'users' ], function () use ($router) {

            $router->get('/', 'UserController@index');
            $router->post('/', 'UserController@store');

        });

    });

});
