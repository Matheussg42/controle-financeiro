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

Route::post('login', 'UserController@authenticate');
Route::post('register', 'UserController@register');



Route::group(['prefix' => 'v1', 'middleware' => 'jwt-auth'], function () {
    Route::apiResources([
        'months'                => 'MonthController',
        'payments'              => 'PaymentController',
        'income'                => 'IncomeController',
    ]);

    Route::get('currentYear', 'MonthController@getCurrentYear')->name('months.getCurrentYear');
    Route::get('currentMonth', 'MonthController@getCurrentMonth')->name('months.getCurrent');
    Route::get('currentMonth/income/', 'IncomeController@currentMonthIncome')->name('income.getCurrentIncome');
    Route::get('currentMonth/payment/', 'PaymentController@currentMonthPayment')->name('payments.getCurrentPayments');
    Route::get('getMonth/payments/{id}', 'PaymentController@getMonthPayments')->name('payments.getMonth');
    Route::get('getMonth/income/{id}', 'IncomeController@getMonthIncome')->name('income.getMonth');
    Route::put('closeMonth/{id}', 'MonthController@close')->name('months.close');
    Route::put('closeOtherMonth/{id}', 'MonthController@closeOtherMonth')->name('months.closeOther');
    Route::post('logout', 'UserController@logout');
});