<?php

namespace Tests\Unit;

use App\User;
use App\Payment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentTest extends TestCase
{

    /**
    * test_instance_of_payment
    * 
    * @return $payment
    */
    public function test_instance_of_payment()
    {
        $payment = new Payment;
        echo "\n Unit - test_instance_of_payment: ok";
        $this->assertInstanceOf(Payment::class,$payment);
        return $payment;
    }

    /**
     * test_create_payment
    * 
    * @return $payment
    */
    public function test_create_payment()
    {
        $payment = factory('App\Payment')->create();
        echo "\n Unit - test_create_payment: ok";
        $this->assertDataBaseHas('payments',['id' => $payment->id]);
        return $payment;
    }

    /**
     * test_find_payment
    * 
    * @return $payment
    */
    public function test_find_payment()
    {
        $payment = factory('App\Payment')->create();
        echo "\n Unit - test_find_payment: ok";
        $this->assertDataBaseHas('payments',['id' => $payment->id]);
    }

    /**
     * test_update_payment
    * 
    * @return $payment
    */
    public function test_update_payment()
    {
        $payment = factory('App\Payment')->create();

        $data = array(
            'name' => 'Conta Teste Atualizada',
        );

        $payment->update($data);
        echo "\n Unit - test_update_payment: ok";
        $this->assertDataBaseHas('payments',['name' => 'Conta Teste Atualizada']);
        
    }

    /**
     * test_destroy_payment
    * 
    * @return $payment
    */
    public function test_destroy_payment()
    {
        $payment = factory('App\Payment')->create();
        $payment->delete();
        echo "\n Unit - test_destroy_payment: ok";
        $this->assertDatabaseMissing('payments',['id' => $payment->id]);
    }
}