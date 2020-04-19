<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Income;
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

$factory->define(App\Income::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'yearMonth' => 1,
        'value'    => 100,
        'date'  => '01/01/2020',
        'name'      => 'Salario Teste',
        'comment'     => 'Comentario para a Conta Teste'
    ];
});
