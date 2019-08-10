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
    	Route::get('search', 'API\InventoryController@search')->name('inventorySearch');
	});
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
