@extends('layouts.app')

@section('content')
    <h1>Lista de Afazeres</h1>

    <!-- Formulário para adicionar uma nova tarefa -->
    <form method="POST" action="/tasks">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tarefa</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="prioridade" class="form-label">Prioridade</label>
            <input type="text" class="form-control" id="prioridade" name="prioridade">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria">
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" id="data" name="data">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
    </form>

    <hr>

    <!-- Lista de tarefas -->
    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item">
                {{ $task->title }}
                <span class="badge bg-secondary">{{ $task->prioridade }}</span>
                <span class="badge bg-info">{{ $task->categoria }}</span>
                <span class="badge bg-warning">{{ $task->data }}</span>
                <form method="POST" action="/tasks/{{ $task->id }}" class="float-end">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                </form>
                <form method="POST" action="/tasks/{{ $task->id }}" class="float-end me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
