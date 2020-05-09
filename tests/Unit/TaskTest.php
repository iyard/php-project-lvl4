<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;
use App\User;
use App\Tag;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $task;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->task = factory(Task::class)->create();
        $this->task->tags()->createMany(
            factory(Tag::class, 3)->make()->toArray()
        );
//        $this->user = factory(User::class)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)
            ->post(route('tasks.store', ['task' => $this->task,
                                            'name' => $this->task->name,
                                            'description' => $this->task->description,
                                            'status_id' => $this->task->status_id,
                                            'creator_id' => $this->task->creator_id,
                                            'assignedTo_id' => $this->task->assignedTo_id,
                                            'tags' => getTagsString($this->task->id)
                                            ]));
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'name' => $this->task->name,
            'description' => $this->task->description,
            'status_id' => $this->task->status_id,
            'creator_id' => $this->task->creator_id,
            'assignedTo_id' => $this->task->assignedTo_id
        ]);
    }

    public function testShow()
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.show', $this->task));
        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.edit', $this->task));
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $updatedTask = factory(Task::class)->make();
        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', ['task' => $this->task,
                                            'name' => $updatedTask->name,
                                            'description' => $updatedTask->description,
                                            'status_id' => $updatedTask->status_id,
                                            'creator_id' => $updatedTask->creator_id,
                                            'assignedTo_id' => $updatedTask->assignedTo_id,
                                            'tags' => getTagsString($this->task->id)
                                            ]));
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'name' => $updatedTask->name,
            'description' => $updatedTask->description,
            'status_id' => $updatedTask->status_id,
            'creator_id' => $updatedTask->creator_id,
            'assignedTo_id' => $updatedTask->assignedTo_id
        ]);
        $tags = $this->task->tags()->get();
        foreach ($tags as $tag) {
            $this->assertDatabaseHas('tag_task', [
                'tag_id' => $tag->id,
                'task_id' => $this->task->id
            ]);
        }
    }

    public function testDestroy()
    {
        $tags = $this->task->tags()->get();

        $response = $this->actingAs($this->user)
                         ->delete(route('tasks.destroy', $this->task));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks', [
            'name' => $this->task->name,
            'description' => $this->task->description,
            'status_id' => $this->task->status_id,
            'creator_id' => $this->task->creator_id,
            'assignedTo_id' => $this->task->assignedTo_id
        ]);

        foreach ($tags as $tag) {
            $this->assertDatabaseMissing('tag_task', [
                'tag_id' => $tag->id,
                'task_id' => $this->task->id
            ]);
        }
    }
}
