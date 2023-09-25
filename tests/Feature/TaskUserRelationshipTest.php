<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_associate_a_task_with_a_user()
    {
        // Crie um usuário
        $user = User::factory()->create();

        // Crie uma tarefa associada ao usuário
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Minha Tarefa de Teste',
        ]);

        // Verifique se a tarefa está associada ao usuário corretamente
        $this->assertInstanceOf(User::class, $task->user);
        $this->assertEquals('Minha Tarefa de Teste', $task->title);
        $this->assertEquals($user->id, $task->user->id);
    }
}
