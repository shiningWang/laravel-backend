<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * API Testing
     *
     * @return void
     */
    public function test_login_route()
    {
        $response = $this
            ->withHeaders(['X-Header' => 'Value'])
            ->post('/api/login', ['email'=>'weiyuwuchang@gmail.com', 'password'=>'12341234']);
        
        $response
            ->assertStatus(200)
            // check value of key
            ->assertJson(['token_type'=>'Bearer'])
            // check items quantity in json
            ->assertJsonCount($key = 3)
            // check value type
            ->assertJson(fn (AssertableJson $json) =>
                $json->whereAllType([
                    'message' => 'string',
                    'access_token' => 'string',
                    'token_type' => 'string'
                ])
                //->etc() if any other items in this obj
            );

        // define the token
        $json = $response->json();
        $token = $json['access_token'];
        // check if the token length is larger than 40
        if( strlen($token) <= 40){
            $this->assertTrue(false, 'Token Not In Desired Length Range');
        } else {
            $this->assertTrue(true);
        };
    }
}
