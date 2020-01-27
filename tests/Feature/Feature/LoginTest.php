<?php

namespace Tests\Feature\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRequireEmailAndLogin()
    {
        $this->json('POST', 'api/login')
        ->assertStatus(422)
        ->assertJson([
            'email' => ['The email field is required'],
            'password' => ['The password field is required']
        ]);
    }

    public function testUserLoginSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testLogin@user.com',
            'password' => bcrypt(123456)
        ]);
        
        $payload = ['email' => 'testLogin@user.com', 'password' => bcrypt(123456)];

        $this->json('POST', 'api:login', $payload)
            ->assertStatus(200)
            ->assertJsonSignature([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token'
                ]
            ]);
    }
}
