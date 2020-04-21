<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    /**
     * A test for endpoint GET -> api/v1/payments.
     *
     * @return void
     */
    public function test_endpoit_payment_index()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/payments', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_index: ok";
        $response
            ->assertStatus(200);
        
    }

    /**
     * A test for endpoint POST -> api/v1/payments.
     *
     * @return void
     */
    public function test_endpoit_payment_create()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $payment = [
            "yearMonth" => 1,
            "value" => 400,
            "date" => "11/4/2020",
            "name" => "Compras",
            "comment" => "Compras no Supermercado BH"
        ];

        $response = $this->postJson('/api/v1/payments', $payment, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_create: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/payments/{ID}.
     *
     * @return void
     */
    public function test_endpoit_payment_get()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/payments/1', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_get: ok";
        $response
            ->assertStatus(200);
        
    }

    /**
     * A test for endpoint PUT -> api/v1/payments/{id}.
     *
     * @return void
     */
    public function test_endpoit_payment_update(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $payment = [
            "value" => 500
        ];

        $response = $this->putJson('/api/v1/payments/1', $payment, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_update: ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => ['Value' => 500],
            ]);
    }

        /**
     * A test for endpoint PUT -> api/v1/payments/{id}.
     *
     * @return void
     */
    public function test_endpoit_payment_update_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $payment = [
            "value" => 500
        ];

        $response = $this->putJson('/api/v1/payments/5', $payment, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_update_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }

    /**
     * A test for endpoint DELETE -> api/v1/payments/{id}.
     *
     * @return void
     */
    public function test_endpoit_payment_delete(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->deleteJson('/api/v1/payments/1', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_delete: ok";
        $response
            ->assertStatus(200);
    }
    
    /**
     * A test for endpoint DELETE -> api/v1/payments/{id}.
     *
     * @return void
     */
    public function test_endpoit_payment_delete_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->deleteJson('/api/v1/payments/5', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_delete_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }

    /**
     * A test for endpoint GET -> api/v1/currentMonth/payment.
     *
     * @return void
     */
    public function test_endpoit_payment_currentMonth()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $CreateMonth = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        $payment = [
            "yearMonth" => 2,
            "value" => 400,
            "date" => "11/4/2020",
            "name" => "Compras",
            "comment" => "Compras no Supermercado BH"
        ];

        $CreatePayment = $this->postJson('/api/v1/payments', $payment, ['HTTP_Authorization' => 'Bearer '. $token]);

        $response = $this->getJson('/api/v1/currentMonth/payment', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_currentMonth: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/currentMonth/payment.
     *
     * @return void
     */
    public function test_endpoit_payment_currentMonth_fail()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/currentMonth/payment', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_currentMonth_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
        
    }

    /**
     * A test for endpoint GET -> api/v1/getMonth/payments/{ID}.
     *
     * @return void
     */
    public function test_endpoit_payment_getMonth()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/getMonth/payments/1', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_getMonth: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/getMonth/payments//{ID}.
     *
     * @return void
     */
    public function test_endpoit_payment_getMonth_fail()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/getMonth/payments/20', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_payment_getMonth_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }
}
