<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_complete_a_task()
    {
        $this->signIn();

        $task = create(Task::class, ['user_id' => auth()->id()]);

        $this->post(route('tasks.update'), [
            'completed_at' => now()
        ])->assertRedirect(route('tasks.index'));

        $task->fresh();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed_at' => $task->completed_at
        ]);

    }


    public function an_authenticated_user_can_delete_a_task()
    {

    }

    public function an_authenticated_user_can_assign_a_priority_to_a_task()
    {

    }

    /** @test */
    public function an_authenticated_user_can_create_a_task()
    {
        $this->signIn();

        $task = make(Task::class, ['user_id' => auth()->id()]);

        $this->post(route('tasks.store'), $task->toArray())->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $task->toArray());
    }

    /** @test */
    public function an_unauthenticated_user_cannot_access_tasks()
    {
        $this->get(route('tasks.index'))->assertRedirect('login/google');
    }

}
