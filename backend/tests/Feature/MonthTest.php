<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonthTest extends TestCase
{
    /**
     * A test for endpoint GET -> api/v1/months.
     *
     * @return void
     */
    public function test_endpoit_month_index()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/months', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_index: ok";
        $response
            ->assertStatus(200);
        
    }

    /**
     * A test for endpoint POST -> api/v1/months.
     *
     * @return void
     */
    public function test_endpoit_month_create()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_create: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint POST -> api/v1/months.
     *
     * @return void
     */
    public function test_endpoit_month_create_fail()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        $response = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_create_fail:['Esse mês já foi criado!'] Ok";
        $response
            ->assertStatus(403)
            ->assertJson([
                'error' => "Esse mês já foi criado!",
            ]);
    }

    /**
     * A test for endpoint PUT -> api/v1/months/{id}.
     *
     * @return void
     */
    public function test_endpoit_month_update(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $data =[
            'received' => 1000,
            'paid' => 100,
            'total' => 900,
        ];

        $response = $this->putJson('/api/v1/months/1', $data, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_update: ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => ['Received' => 1000],
            ]);
    }

    /**
     * A test for endpoint GET -> api/v1/currentYear.
     *
     * @return void
     */
    public function test_endpoit_month_currentYear(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/currentYear', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_currentYear: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/currentMonth.
     *
     * @return void
     */
    public function test_endpoit_month_currentMonth(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $create = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);
        $response = $this->getJson('/api/v1/currentMonth', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_currentMonth: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/currentMonth.
     *
     * @return void
     */
    public function test_endpoit_month_currentMonth_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/currentMonth', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_currentMonth_fail: [Nada Encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => "Nada Encontrado",
            ]);
    }
    
    /**
     * A test for endpoint GET -> api/v1/months/{ID}.
     *
     * @return void
     */
    public function test_endpoit_month_get(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/months/1', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_get: ok";
        $response
            ->assertStatus(200);
    }

    /**
     * A test for endpoint GET -> api/v1/months/{ID}.
     *
     * @return void
     */
    public function test_endpoit_month_get_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->getJson('/api/v1/months/5', ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_get: [Nada Encontrado] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => "Nada Encontrado",
            ]);
    }

    /**
     * A test for endpoint PUT -> api/v1/closeOtherMonth/{ID}.
     *
     * @return void
     */
    public function test_endpoit_month_closeOtherMonth(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->putJson('/api/v1/closeOtherMonth/1', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_closeOtherMonth: Ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => ['Status' => 'fechado'],
            ]);
    }

    /**
     * A test for endpoint PUT -> api/v1/closeOtherMonth/{ID}.
     *
     * @return void
     */
    public function test_endpoit_month_closeOtherMonth_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->putJson('/api/v1/closeOtherMonth/5', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_closeOtherMonth_fail: ['O mês não foi encontrado'] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }
    
    /**
     * A test for endpoint PUT -> api/v1/closeMonth/{ID}.
     *
     * @return void
     */
    public function test_endpoit_month_closeMonth(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $create = $this->postJson('/api/v1/months', [], ['HTTP_Authorization' => 'Bearer '. $token]);
        $monthId = $create->json()['data']['id'];

        $dataPut =[
            "received"=> 3000,
            "paid"=> 900
        ];

        $response = $this->putJson("/api/v1/closeMonth/{$monthId}", $dataPut, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_closeMonth: Ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => ['Status' => 'fechado'],
            ]);
    }

    /**
     * A test for endpoint PUT -> api/v1/closeMonth/{ID}.
     *
     * @return void
     */
    public function test_endpoit_month_closeMonth_fail(){
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $dataPut =[
            "received"=> 3000,
            "paid"=> 900
        ];

        $response = $this->putJson("/api/v1/closeMonth/5", $dataPut, ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_month_closeMonth_fail: ['O mês não foi encontrado'] Ok";
        $response
            ->assertStatus(404)
            ->assertJson([
                "error" => 'Nada Encontrado',
            ]);
    }

}
