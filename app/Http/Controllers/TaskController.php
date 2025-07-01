<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latestFirst()->paginate(10); // Show 10 tasks per page
        return view('tasks.index', compact('tasks'));
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create(['name' => $request->name]);
        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function toggle(Task $task)
    {
        $task->toggleComplete();
       return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }
}
