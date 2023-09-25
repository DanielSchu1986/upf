<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_edit_task_page()
    {
        $task = Task::factory()->create();

        $response = $this->get("/tasks/{$task->id}/edit");

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_edit_task_page()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/tasks/{$task->id}/edit");

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_update_task()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Tarefa Atualizada',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_update_own_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'Tarefa Atualizada',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tasks');
    }

    public function test_authenticated_user_cannot_update_other_users_task()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->put("/tasks/{$task->id}", [
            'title' => 'Tarefa Atualizada',
        ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_delete_own_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/tasks');
    }

    public function test_authenticated_user_cannot_delete_other_users_task()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->delete("/tasks/{$task->id}");

        $response->assertStatus(403);
    }
}
