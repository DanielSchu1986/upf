<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_task()
    {
        // Crie uma nova tarefa
        $task = Task::create([
            'title' => 'Minha Tarefa de Teste',
            'prioridade' => 'Alta',
            'categoria' => 'Trabalho',
            'data' => now(),
            'completed' => false,
        ]);

        // Verifique se a tarefa foi criada corretamente
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('Minha Tarefa de Teste', $task->title);
        $this->assertEquals('Alta', $task->prioridade);
        $this->assertEquals('Trabalho', $task->categoria);
        $this->assertFalse($task->completed);
    }
}
