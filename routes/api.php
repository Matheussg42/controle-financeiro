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

Route::post('login', 'Auth\LoginController@login');



Route::group(['prefix' => 'v1', 'middleware' => 'jwt.auth'], function () {
    Route::apiResources([
        'periodos'   => 'PeriodoController',
        'users'     => 'UserController',
    ]);

    Route::put('close-periodo/{id}', 'PeriodoController@close')->name('periodos.close');
    Route::post('logout', 'Auth\LoginController@logout');
});