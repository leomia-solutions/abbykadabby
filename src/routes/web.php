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

$router->get('hello', [
	'as' => 'hello-world', 
	'uses' => 'Api\V1\HelloWorldController@hello',
]);

$router->group(['namespace' => 'API'], function () use ($router) {
	
	$router->group(['namespace' => 'V1'], function () use ($router) {
		
		$router->group(['prefix' => 'v1'], function () use ($router) {

			$router->group(['prefix' => 'users'], function () use ($router) {

				$router->post('login', [
					'as' => 'user-login',
					'uses' => 'UserController@login',
				]);

			});

		});

	});

});

// Authentication-gated routes
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('gate', [ 
    	'as' => 'gate', 
    	'uses' => 'AuthTestController@gate',
    ]);

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });
});
