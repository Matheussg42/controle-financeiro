<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A test for endpoint api/register.
     *
     * @return void
     */
    public function test_endpoit_register()
    {
        $data = [
            'name'=> "UserTest", 
            'email'=> "usertest@gmail.com", 
            'password'=> "12345", 
            'password_confirmation'=> "12345"
        ];

        $response = $this->postJson('/api/register', $data);

        echo "\n Feature - test_endpoit_register: ok";
        $response
            ->assertStatus(201);
        
    }

    /**
     * A test for fail endpoint api/register.
     *
     * @return void
     */
    public function test_endpoit_register_fail()
    {
        $data = [
            'name'=> "", 
            'email'=> "", 
            'password'=> "", 
            'password_confirmation'=> ""
        ];

        $response = $this->postJson('/api/register', $data);

        echo "\n Feature - test_endpoit_register_fail: ok";
        $response
            ->assertStatus(400);
        
    }

    /**
     * A test for endpoint api/login.
     *
     * @return void
     */
    public function test_endpoit_login()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $response = $this->postJson('/api/login', $data);

        echo "\n Feature - test_endpoit_login: ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => "success",
            ]);
        
    }

    /**
     * A test for fail endpoint api/login.
     *
     * @return void
     */
    public function test_endpoit_login_fail()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "14523"
        ];

        $response = $this->postJson('/api/login', $data);

        echo "\n Feature - test_endpoit_login_fail: ok";
        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => "invalid_credentials",
            ]);
        
    }

    /**
     * A test for endpoint api/login.
     *
     * @return void
     */
    public function test_endpoit_logout()
    {
        $data = [
            'email'=> "matheusbhsantos2@gmail.com", 
            'password'=> "12345"
        ];

        $login = $this->postJson('/api/login', $data);
        $token = $login->json()['token'];

        $response = $this->postJson('/api/v1/logout', [], ['HTTP_Authorization' => 'Bearer '. $token]);

        echo "\n Feature - test_endpoit_logout: ok";
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => "success",
            ]);
        
    }

    /**
     * A test for invalid token in endpoints.
     *
     * @return void
     */
    public function test_token_invalid()
    {
        $response = $this->postJson('/api/v1/logout', [], ['HTTP_Authorization' => 'Bearer '. '1234asfasf2a6sfa51sf51as']);

        echo "\n Feature - test_token_invalid: ok";
        $response
            ->assertJson([
                'status' => 401,
                'msg' => "Token inválido",
            ]);
        
    }
}
