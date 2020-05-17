<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
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
        $response->assertOk();
    }

    public function testEdit()
    {
        $response = $this->actingAs($this->user)
            ->get(route('users.edit', $this->user));
        $response->assertOk();
    }

    public function testDestroy()
    {
        $response = $this->actingAs($this->user)
                         ->delete(route('users.destroy', $this->user));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id' => $this->user->id]);
    }
}
