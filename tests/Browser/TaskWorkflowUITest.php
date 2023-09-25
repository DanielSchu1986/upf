<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskWorkflowUITest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_task_workflow()
    {
        $this->browse(function (Browser $browser) {
            // Cenário 1: Criação de Tarefa
            $browser->visit('/tasks/create')
                ->type('title', 'Nova Tarefa')
                ->select('prioridade', 'Alta')
                ->select('categoria', 'Trabalho')
                ->type('data', '2023-09-30')
                ->press('Adicionar Tarefa')
                ->assertSee('Tarefa criada com sucesso');

            // Verifique se a tarefa foi criada no banco de dados
            $this->assertDatabaseHas('tasks', [
                'title' => 'Nova Tarefa',
                'prioridade' => 'Alta',
                'categoria' => 'Trabalho',
                'data' => '2023-09-30',
            ]);

            // Cenário 2: Leitura de Tarefa
            $browser->visit('/tasks')
                ->assertSee('Nova Tarefa');

            // Cenário 3: Atualização de Tarefa
            $browser->visit('/tasks')
                ->click('@edit-task-1') // Substitua "1" pelo ID da tarefa criada
                ->type('title', 'Tarefa Atualizada')
                ->press('Atualizar Tarefa')
                ->assertSee('Tarefa atualizada com sucesso');

            // Verifique se a tarefa foi atualizada no banco de dados
            $this->assertDatabaseHas('tasks', [
                'title' => 'Tarefa Atualizada',
            ]);

            // Cenário 4: Exclusão de Tarefa
            $browser->visit('/tasks')
                ->click('@delete-task-1') // Substitua "1" pelo ID da tarefa criada
                ->acceptDialog()
                ->assertSee('Tarefa excluída com sucesso');

            // Verifique se a tarefa foi removida do banco de dados
            $this->assertDatabaseMissing('tasks', [
                'title' => 'Tarefa Atualizada',
            ]);
        });
    }
}
