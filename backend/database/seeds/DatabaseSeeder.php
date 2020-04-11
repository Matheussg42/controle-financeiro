<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Matheus S. Gomes",
            'email' => 'matheusbhsantos2@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        DB::table('months')->insert([
            'user_id'   => 1,
            'yearMonth' => '2020_1',
            'ticket'    => 0.00,
            'received'  => 0.00,
            'paid'      => 0.00,
            'total'     => 0.00,
            'status'    => 'aberto',
            'created_at'=> '2020-01-01 22:07:53',
            'updated_at'=> '2020-01-01 22:07:53'
        ]);

        DB::table('incomes')->insert([
            'user_id'   => 1,
            'yearMonth' => 1,
            'value'     => 1000.00,
            'name'      => "Salario",
            'comment'   => "Caiu no dia 01/09",
            'date'      => "01/01/2020",
            'created_at'=> '2020-01-01 22:07:53',
            'updated_at'=> '2020-01-01 22:07:53'
        ]);

        DB::table('payments')->insert([
            'user_id'   => 1,
            'yearMonth' => 1,
            'value'     => 300.00,
            'name'      => "Celular 2/4",
            'comment'   => "Redmi Note 7",
            'date'      => "01/01/2020",
            'created_at'=> '2020-01-01 22:07:53',
            'updated_at'=> '2020-01-01 22:07:53'
        ]);
    }
}
