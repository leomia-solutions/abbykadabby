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
	Route::prefix('inventory')->group(function () {
    	Route::get('/', 'API\InventoryController@list')->name('apiInventoryList');
    	Route::post('/', 'API\InventoryController@create')->name('apiInventoryCreate');
    	Route::get('{item}', 'API\InventoryController@show')->name('apiInventoryShow');
    	Route::patch('{item}', 'API\InventoryController@update')->name('apiInventoryUpdate');
    	Route::delete('{item}', 'API\InventoryController@delete')->name('apiInventoryDelete');
	});
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
