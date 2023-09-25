<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskAttributesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fill_task_attributes()
    {
        // Crie uma instância do modelo Task com atributos definidos
        $task = new Task([
            'title' => 'Minha Tarefa de Teste',
            'prioridade' => 'Alta',
            'categoria' => 'Trabalho',
            'data' => now(),
            'completed' => false,
        ]);

        // Verifique se os atributos estão preenchidos corretamente
        $this->assertEquals('Minha Tarefa de Teste', $task->title);
        $this->assertEquals('Alta', $task->prioridade);
        $this->assertEquals('Trabalho', $task->categoria);
        $this->assertFalse($task->completed);
    }
}
