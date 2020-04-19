<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Month;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Month::class, function (Faker $faker) {
    $now = Carbon::now();
    $yearMonth = (string) $now->year . "_" . $now->month;
    
    return [
        'user_id' => 1,
        'yearMonth' => $yearMonth,
        'ticket'    => 0.00,
        'received'  => 0.00,
        'paid'      => 0.00,
        'total'     => 0.00,
        'status'    => 'aberto'
    ];
});
