<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_index_route()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    public function test_task_create_route()
    {
        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
    }

    public function test_task_store_route()
    {
        $response = $this->post('/tasks', [
            'title' => 'Nova Tarefa',
            'prioridade' => 'Alta',
            'categoria' => 'Trabalho',
            'data' => '2023-09-30',
        ]);
        $response->assertStatus(302);
    }

    public function test_task_show_route()
    {
        $response = $this->get('/tasks/1'); // Substitua "1" pelo ID de uma tarefa existente
        $response->assertStatus(200);
    }

    public function test_task_edit_route()
    {
        $response = $this->get('/tasks/1/edit'); // Substitua "1" pelo ID de uma tarefa existente
        $response->assertStatus(200);
    }

    public function test_task_update_route()
    {
        $response = $this->put('/tasks/1', [
            'title' => 'Tarefa Atualizada',
        ]); // Substitua "1" pelo ID de uma tarefa existente
        $response->assertStatus(302);
    }

    public function test_task_destroy_route()
    {
        $response = $this->delete('/tasks/1'); // Substitua "1" pelo ID de uma tarefa existente
        $response->assertStatus(302);
    }
}
