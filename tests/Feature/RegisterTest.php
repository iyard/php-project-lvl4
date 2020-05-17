<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $user = factory(\App\User::class)->make();
        $this->user = $user->toArray();
    }

    public function testRegisterFormDisplayed()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function testRegisterValidUser()
    {
        $response = $this->post(route('register'), $this->user);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'name' => $this->user['name'],
            'email' => $this->user['email']
        ]);
        $this->assertAuthenticated();
    }

    public function testRegisterNotValidUser()
    {
        $this->user['password_confirmation'] = 'invalid';

        $response = $this->post(route('register'), $this->user);
        $response->assertStatus(302);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
