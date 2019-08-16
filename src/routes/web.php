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
    Route::get('/', 'Controller@index')->name('inventoryList');
    Route::get('/add', 'Controller@index')->name('inventoryCreate');
    Route::get('/{item}', 'Controller@index')->name('inventoryShow');
});

Route::get('/', 'Controller@index');

Route::prefix('login')->group(function () {
    Route::get('/', 'Controller@index')->name('login');
});

Route::prefix('users')->group(function () {
    Route::get('register', 'Controller@index')->name('registerUser');
});

Route::get('forgotPassword', 'Controller@index')->name('forgotPassword');
