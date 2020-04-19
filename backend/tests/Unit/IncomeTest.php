<?php

namespace Tests\Unit;

use App\User;
use App\Income;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IncomeTest extends TestCase
{
    /**
    * test_instance_of_income
    * 
    * @return $income
    */
    public function test_instance_of_income()
    {
        $income = new Income;
        echo "\n Unit - test_instance_of_income: ok";
        $this->assertInstanceOf(Income::class,$income);
        return $income;
    }

    /**
     * test_create_income
    * 
    * @return $income
    */
    public function test_create_income()
    {
        $income = factory('App\Income')->create();
        echo "\n Unit - test_create_income: ok";
        $this->assertDataBaseHas('incomes',['id' => $income->id]);
        return $income;
    }

    /**
     * test_find_income
    * 
    * @return $income
    */
    public function test_find_income()
    {
        $income = factory('App\Income')->create();
        echo "\n Unit - test_find_income: ok";
        $this->assertDataBaseHas('incomes',['id' => $income->id]);
    }

    /**
     * test_update_income
    * 
    * @return $income
    */
    public function test_update_income()
    {
        $income = factory('App\Income')->create();

        $data = array(
            'name' => 'Conta Teste Atualizada',
        );

        $income->update($data);
        echo "\n Unit - test_update_income: ok";
        $this->assertDataBaseHas('incomes',['name' => 'Conta Teste Atualizada']);
        
    }

    /**
     * test_destroy_income
    * 
    * @return $income
    */
    public function test_destroy_income()
    {
        $income = factory('App\Income')->create();
        $income->delete();
        echo "\n Unit - test_destroy_income: ok";
        $this->assertDatabaseMissing('incomes',['id' => $income->id]);
    }
}