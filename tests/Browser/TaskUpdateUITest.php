<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskUpdateUITest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_update_task()
    {
        $this->browse(function (Browser $browser) {
            // Crie uma tarefa para testar
            $task = \App\Models\Task::factory()->create([
                'title' => 'Tarefa Original',
            ]);

            $browser->visit("/tasks/{$task->id}/edit")
                ->type('title', 'Tarefa Editada')
                ->press('Atualizar Tarefa')
                ->assertSee('Tarefa atualizada com sucesso');

            // Verifique se a tarefa foi atualizada no banco de dados
            $this->assertDatabaseHas('tasks', [
                'id' => $task->id,
                'title' => 'Tarefa Editada',
            ]);
        });
    }
}
