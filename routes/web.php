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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'can:view-AdminCabinetController'], function() {
    Route::resource('admin', 'AdminCabinetController');

    Route::post('users', 'AdminCabinetController@usersList')->name('users');

    Route::post('/get-allowed-controllers', 'AdminCabinetController@getAllowedControllers')->name('getAllowedControllers');
});

Route::group(['middleware' => 'can:view-PageController'], function() {
    Route::get('/page1', 'PageController@page1');

    Route::get('/page2', 'PageController@page2');
});
