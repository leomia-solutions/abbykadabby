<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['api'])->group(function () {
    Route::post('login', 'API\UserController@login')->name('apiUserLogin');

    Route::prefix('inventory')->group(function () {
        Route::get('/', 'API\InventoryController@list')->name('apiInventoryList');
        Route::post('/', 'API\InventoryController@create')->name('apiInventoryCreate');
        Route::get('{item}', 'API\InventoryController@show')->name('apiInventoryShow');
        Route::patch('{item}', 'API\InventoryController@update')->name('apiInventoryUpdate');
        Route::delete('{item}', 'API\InventoryController@delete')->name('apiInventoryDelete');
    });

    Route::prefix('users')->group(function () {
        Route::post('/', 'API\UserController@create')->name('apiUserCreate');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('me', 'API\UserController@me')->name('apiUserMe');
        Route::get('{$id}', 'API\UserController@show')->name('apiUserShow');
    });
});
