<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskDeletionUITest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_delete_task()
    {
        $this->browse(function (Browser $browser) {
            // Crie uma tarefa para testar
            $task = \App\Models\Task::factory()->create([
                'title' => 'Tarefa para Excluir',
            ]);

            $browser->visit('/tasks')
                ->click('@delete-task-' . $task->id)
                ->acceptDialog()
                ->assertSee('Tarefa excluída com sucesso');

            // Verifique se a tarefa foi removida do banco de dados
            $this->assertDatabaseMissing('tasks', [
                'id' => $task->id,
            ]);
        });
    }
}
