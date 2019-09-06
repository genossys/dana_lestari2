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
    return view('umum.welcome');
});

Auth::routes();

Route::get('/administrator', 'Auth\Admin\LoginController@showLoginForm');
Route::post('/postlogin', 'Auth\Admin\LoginController@postlogin');
Route::get('/logout', 'Auth\Admin\LoginController@logout')->name('logoutadmin');

Route::get('/formKredit', 'Admin\Master\kreditController@index');
Route::post('/ajukankredit', 'Admin\Master\kreditController@add');
Route::get('/formDeposito', 'Admin\Master\depositoController@index');
Route::post('/ajukandeposito', 'Admin\Master\depositoController@add');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\dashboardController@index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'Admin\Master\userController@index')->name('pageuser');
        Route::get('/view', 'Admin\Master\userController@getData');
        Route::get('/new', 'Admin\Master\userController@showForm');
        Route::post('/add', 'Admin\Master\userController@add');
        Route::get('/store', 'Admin\Master\userController@store');
        Route::post('/update', 'Admin\Master\userController@edit');
        Route::delete('/delete', 'Admin\Master\userController@delete');
    });
    Route::group(['prefix' => 'kredit'], function () {
        Route::get('/', 'Admin\Master\kreditController@adminpage')->name('pagekredit');
        Route::get('/view', 'Admin\Master\kreditController@getData');
        Route::get('/confirm', 'Admin\Master\kreditController@confirm');
        Route::get('/store', 'Admin\Master\userController@store');
        Route::post('/update', 'Admin\Master\userController@edit');
        Route::delete('/delete', 'Admin\Master\userController@delete');
    });
});
