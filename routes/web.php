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

        $router->group([ 'middleware' => 'auth' ], function () use ($router) {

            //User routes
            $router->get('users[/{id}]', 'UserController@show'); //Optional url parameter "id"
            $router->post('users', 'UserController@store');
            $router->put('users/{id}', 'UserController@update');
            $router->patch('users/{id}', 'UserController@update');
            $router->delete('users/{id}', 'UserController@delete');

        });

        $router->group([ 'middleware' => 'client.credentials' ], function () use ($router) {

            //Example routes
            $router->get('examples[/{id}]', 'ExampleController@show'); //Optional url parameter "id"
            $router->post('examples', 'ExampleController@store');
            $router->put('examples/{id}', 'ExampleController@update');
            $router->patch('examples/{id}', 'ExampleController@update');
            $router->delete('examples/{id}', 'ExampleController@delete');

        });

    });

});
