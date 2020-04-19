<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
    * test_instance_of_user
    * 
    * @return $user
    */
    public function test_instance_of_user()
    {
        $user = new User;
        echo "\n Unit - test_instance_of_user: ok";
        $this->assertInstanceOf(User::class,$user);
        return $user;
    }

    /**
    * test_create_user
    * 
    * @return $user
    */
    public function test_create_user()
    {
        $user = factory('App\User')->create();
        echo "\n Unit - test_create_user: ok";
        $this->assertDataBaseHas('users',['id' => $user->id]);
        return $user;
    }

    /**
    * test_show_user
    * 
    * @return $user
    */
    public function test_show_user()
    {
        $user = factory('App\User')->create();
        echo "\n Unit - test_show_user: ok";
        $this->assertDataBaseHas('users',['id' => $user->id]);
    }
}