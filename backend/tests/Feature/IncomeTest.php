<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomeTest extends TestCase
{
    /**
     * A test for endpoint GET -> api/v1/income.
     *
     * @return void
     */
    public function test_endpoit_income_index()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/income', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_index: ok";
        $response
            ->assertStatus(200);
        
    }

    /**
     * A test for endpoint POST -> api/v1/income.
     *
     * @return void
     */
    public function test_endpoit_income_create()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $income = [
            "yearMonth" => 1,
            "value" => 400,
            "date" => "11/4/2020",
            "name" => "Compras",
            "comment" => "Compras no Supermercado BH"
        ];

        $response = $this->postJson('/api/v1/income', $income, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_create: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/income/{ID}.
     *
     * @return void
     */
    public function test_endpoit_income_get()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/income/1', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_get: ok";
        $response
            ->assertStatus(200);
        
    }

    /**
     * A test for endpoint PUT -> api/v1/income/{id}.
     *
     * @return void
     */
    public function test_endpoit_income_update(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $income = [
            "value" => 500
        ];

        $response = $this->putJson('/api/v1/income/1', $income, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_update: ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => ['Value' => 500],
            ]);
    }

        /**
     * A test for endpoint PUT -> api/v1/income/{id}.
     *
     * @return void
     */
    public function test_endpoit_income_update_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $income = [
            "value" => 500
        ];

        $response = $this->putJson('/api/v1/income/5', $income, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_update_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }

    /**
     * A test for endpoint DELETE -> api/v1/income/{id}.
     *
     * @return void
     */
    public function test_endpoit_income_delete(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->deleteJson('/api/v1/income/1', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_delete: ok";
        $response
            ->assertStatus(200);
    }
    
    /**
     * A test for endpoint DELETE -> api/v1/income/{id}.
     *
     * @return void
     */
    public function test_endpoit_income_delete_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->deleteJson('/api/v1/income/5', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_delete_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }

    /**
     * A test for endpoint GET -> api/v1/currentMonth/income.
     *
     * @return void
     */
    public function test_endpoit_income_currentMonth()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $CreateMonth = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        $income = [
            "yearMonth" => 2,
            "value" => 400,
            "date" => "11/4/2020",
            "name" => "Compras",
            "comment" => "Compras no Supermercado BH"
        ];

        $CreateIncome = $this->postJson('/api/v1/income', $income, ['HTTP_Authorization' => 'Bearer '. $token]);

        $response = $this->getJson('/api/v1/currentMonth/income', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_currentMonth: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/currentMonth/income.
     *
     * @return void
     */
    public function test_endpoit_income_currentMonth_fail()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/currentMonth/income', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_income_currentMonth_fail: [Nada encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
        
    }
}
