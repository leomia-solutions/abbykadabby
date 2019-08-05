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
    Route::prefix('inventory')->group(function () {
        Route::post('/', 'InventoryController@store')->name('inventoryStore');
        Route::get('/add', 'InventoryController@create')->name('inventoryCreate');
    });
});

// Routes that can be accessed by anonymous users
Route::get('/', 'InventoryController@list')->name('inventoryList');

Route::prefix('login')->group(function () {
    Route::get('/login', 'UserController@getLogin')->name('login');
    Route::post('/login', 'UserController@doLogin')->name('doLogin');
});
