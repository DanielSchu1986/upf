<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskCreationUITest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_create_valid_task()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks/create')
                ->type('title', 'Tarefa de Teste')
                ->select('prioridade', 'Alta')
                ->select('categoria', 'Trabalho')
                ->type('data', '2023-09-30')
                ->press('Adicionar Tarefa')
                ->assertSee('Tarefa criada com sucesso');

            // Verifique se a tarefa está no banco de dados
            $this->assertDatabaseHas('tasks', [
                'title' => 'Tarefa de Teste',
                'prioridade' => 'Alta',
                'categoria' => 'Trabalho',
                'data' => '2023-09-30',
            ]);
        });
    }
}
