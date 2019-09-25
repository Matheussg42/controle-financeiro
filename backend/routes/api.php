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

    Route::get('currentMonth', 'MonthController@getCurrentMonth')->name('months.getCurrent');
    Route::get('currentMonth/income/', 'IncomeController@currentMonthIncome')->name('income.getCurrentIncome');
    Route::get('currentMonth/payment/', 'PaymentController@currentMonthPayment')->name('payments.getCurrentPayments');
    Route::get('currentMonth/bill/', 'BillController@currentMonthBill')->name('bills.getCurrentBills');
    Route::get('payments/getMonth/{id}', 'PaymentController@getMonthPayments')->name('payments.getMonth');
    Route::get('income/getMonth/{id}', 'IncomeController@getMonthIncome')->name('income.getMonth');
    Route::put('close-month/{id}', 'MonthController@close')->name('months.close');
    Route::post('logout', 'Auth\LoginController@logout');
});