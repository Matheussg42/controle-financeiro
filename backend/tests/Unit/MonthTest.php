<?php

namespace Tests\Unit;

use App\User;
use App\Month;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MonthTest extends TestCase
{

    /**
    * test_instance_of_month
    * 
    * @return $month
    */
    public function test_instance_of_month()
    {
        $month = new Month;
        echo "\n Unit - test_instance_of_month: ok";
        $this->assertInstanceOf(Month::class,$month);
        return $month;
    }

    /**
     * test_create_month
    * 
    * @return $month
    */
    public function test_create_month()
    {
        $month = factory('App\Month')->create();
        echo "\n Unit - test_create_month: ok";
        $this->assertDataBaseHas('months',['id' => $month->id]);
        return $month;
    }

    /**
     * test_find_month
    * 
    * @return $month
    */
    public function test_find_month()
    {
        $month = factory('App\Month')->create();
        echo "\n Unit - test_find_month: ok";
        $this->assertDataBaseHas('months',['id' => $month->id]);
    }

    /**
     * test_update_month
    * 
    * @return $month
    */
    public function test_update_month()
    {
        $month = factory('App\Month')->create();

        $data = array(
            'yearMonth' => '2015_05',
        );

        $month->update($data);
        echo "\n Unit - test_update_month: ok";
        $this->assertDataBaseHas('months',['yearMonth' => '2015_05']);
    }

    /**
     * test_destroy_month
    * 
    * @return $month
    */
    public function test_destroy_month()
    {
        $month = factory('App\Month')->create();
        $month->delete();
        echo "\n Unit - test_destroy_month: ok";
        $this->assertDatabaseMissing('months',['id' => $month->id]);
    }
}