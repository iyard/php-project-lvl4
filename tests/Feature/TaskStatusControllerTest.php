<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TaskStatus;
use App\User;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $status;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->status = new TaskStatus();
        $this->status->name = 'test';
        $this->status->save();
    }

    public function testIndex()
    {
        $responce = $this->get(route('statuses.index'));
        $responce->assertOk();
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('statuses.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)
            ->post(route('statuses.store'), ['name' => $this->status->name]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('task_statuses', [
            'name' => $this->status->name
        ]);
    }

    public function testEdit()
    {
        $response = $this->actingAs($this->user)
            ->get(route('statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $updatedStatus = new TaskStatus();
        $updatedStatus->name = 'test2';
        $response = $this->actingAs($this->user)
            ->patch(route('statuses.update', [
                'status' => $this->status,
                'name' => $updatedStatus->name
            ]));
        $response->assertStatus(302);
        $this->assertDatabaseHas('task_statuses', [
            'name' => $updatedStatus->name
        ]);
    }

    public function testDestroy()
    {
        $response = $this->actingAs($this->user)
                         ->delete(route('statuses.destroy', $this->status));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('task_statuses', [
            'id' => $this->status->id
        ]);
    }
}
