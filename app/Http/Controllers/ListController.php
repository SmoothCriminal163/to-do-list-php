<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function createTask(Request $request)
    {
        $taskName          = $request->input('task_name');
        $taskDescription   = $request->input('task_description');

        $task              = new Task();
        $task->title       = $taskName;
        $task->description = $taskDescription;

        $task->save();

        return redirect('/');
    }

    public function showAllTasks()
    {
        $allTasks = Task::all();
        return view("list", ["allTasks" => $allTasks]);
    }

    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect('/');
    }

    public function destroyTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/');
    }
}
