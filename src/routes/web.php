<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes that require a user be authenticated first
Route::middleware(['auth'])->group(function () {

    // Inventory routes

    // TODO: uncomment once user login becomes necessary
    // Route::prefix('inventory')->group(function () {
    //     Route::post('/', 'InventoryController@store')->name('inventoryStore');
    //     Route::get('/add', 'InventoryController@create')->name('inventoryCreate');
    // });
});

// Routes that can be accessed by anonymous users

Route::prefix('inventory')->group(function () {
    Route::get('/', 'InventoryController@list')->name('inventoryList');
    Route::get('/create', 'InventoryController@create')->name('inventoryCreate');
    Route::get('/{item}', 'InventoryController@show')->name('inventoryShow');
    Route::post('/', 'InventoryController@store')->name('inventoryStore');
    Route::get('/{item}/edit', 'InventoryController@edit')->name('inventoryEdit');
    Route::post('/{item}', 'InventoryController@update')->name('inventoryUpdate');
    Route::get('/{item}/delete', 'InventoryController@delete')->name('inventoryDelete');
});

Route::get('/', 'InventoryController@list');

Route::prefix('login')->group(function () {
    Route::get('/', 'UserController@getLogin')->name('login');
    Route::post('/', 'UserController@doLogin')->name('doLogin');
});

Route::get('forgotPassword', 'UserController@forgotPassword')->name('forgotPassword');
