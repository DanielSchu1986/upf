<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/tasks', [
                'title' => 'Nova Tarefa',
                'prioridade' => 'Alta',
                'categoria' => 'Trabalho',
                'data' => '2023-09-30',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Tarefa criada com sucesso');
        $this->assertDatabaseHas('tasks', ['title' => 'Nova Tarefa']);
    }

    public function test_read_task()
    {
        $task = Task::factory()->create(['title' => 'Tarefa de Leitura']);

        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee('Tarefa de Leitura');
    }

    public function test_update_task()
    {
        $task = Task::factory()->create(['title' => 'Tarefa Antiga']);

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Tarefa Atualizada',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Tarefa atualizada com sucesso');
        $this->assertDatabaseMissing('tasks', ['title' => 'Tarefa Antiga']);
        $this->assertDatabaseHas('tasks', ['title' => 'Tarefa Atualizada']);
    }

    public function test_delete_task()
    {
        $task = Task::factory()->create(['title' => 'Tarefa para Excluir']);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Tarefa excluída com sucesso');
        $this->assertDatabaseMissing('tasks', ['title' => 'Tarefa para Excluir']);
    }
}
