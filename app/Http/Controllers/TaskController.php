<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{


public function index()
{
    $tasks = Task::all();
    return view('tasks.index', compact('tasks'));
}

public function store(Request $request)
{
    Task::create([
        'title' => $request->input('title'),
    ]);
    return redirect('/');
}

public function update(Request $request, Task $task)
{
    $task->update([
        'completed' => $request->has('completed'),
    ]);
    return redirect('/');
}

public function destroy(Task $task)
{
    $task->delete();
    return redirect('/');
}

}
