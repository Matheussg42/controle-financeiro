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
        'months'                => 'MonthController',
        'bills'                 => 'BillController',
        'users'                 => 'UserController',
        'payment-types'         => 'PaymentTypeController',
        'payment-installments'  => 'PaymentInstallmentsController',
        'payments'              => 'PaymentController',
        'income-installments'   => 'IncomeInstallmentsController',
        'income'                => 'IncomeController',
    ]);

    Route::put('close-month/{id}', 'MonthController@close')->name('months.close');
    Route::post('logout', 'Auth\LoginController@logout');
});