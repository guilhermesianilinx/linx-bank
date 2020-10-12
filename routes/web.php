<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function() use ($router) {

    $router->get('/users', 'UserController@index');
    $router->get('/users/{id}', 'UserController@show');
    $router->post('/users', 'UserController@store');

    $router->post('/users/{userId}/accounts/savings', 'UserAccountController@storeSavingsAccount');
    $router->post('/users/{userId}/accounts/checking', 'UserAccountController@storeCheckingAccount');
    $router->post('/users/{id}/accounts/{type}', 'UserAccountController@store');

    $router->post('/users/{id}/accounts/{accountId}/deposit', 'UserAccountTransactionController@makeDeposit');
    $router->post('/users/{id}/accounts/{accountId}/withdraw', 'UserAccountTransactionController@makeWithDraw');

});