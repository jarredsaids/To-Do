<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{

    /** @test */
    public function an_unauthenticated_user_cannot_access_tasks()
    {
        // given a user who is not authenticated
        // when they go to the /tasks route
        // then they will be redirected

        return $this->get(route('tasks.index'))
            ->assertRedirect('login/google');
    }

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
}
