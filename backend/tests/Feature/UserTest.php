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
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/api/register', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
        // {
        //     name: "UserTest", 
        //     email: "usertest@gmail.com", 
        //     password: "12345", 
        //     password_confirmation: "12345"
        // }
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
