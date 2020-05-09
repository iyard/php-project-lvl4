<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testNotAuthUserCantSeeEditRoute()
    {
        $response = $this->get(route('users.edit', $this->user));
        $response->assertRedirect(route('login'));
    }

    public function testShow()
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $response = $this->actingAs($this->user)
                         ->get(route('users.edit', $this->user));
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $updatedUser = factory(User::class)->make();
        $response = $this->actingAs($this->user)
            ->patch(route('users.update', ['user' => $this->user,
                                            'name' => $updatedUser->name,
                                            'email' => $updatedUser->email,
                                            'password' => $updatedUser->password,
                                            'password_confirmation' => $updatedUser->password
                                            ]));
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'name' => $updatedUser->name,
            'email' => $updatedUser->email
        ]);
    }

    public function testDestroy()
    {
        $response = $this->actingAs($this->user)
                         ->delete(route('users.destroy', $this->user));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', [
            'name' => $this->user->name,
            'email' => $this->user->email
        ]);
    }
}
