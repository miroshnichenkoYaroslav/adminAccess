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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin', 'AdminCabinetController')->middleware('auth');

Route::post('users', 'AdminCabinetController@usersList')->name('users');

Route::group(['middleware' => 'checkAccess'], function() {
    Route::get('/page1', function() {
        return view('admin.page1');
    });
    Route::get('/page2', function() {
        return view('admin.page2');
    });
});

