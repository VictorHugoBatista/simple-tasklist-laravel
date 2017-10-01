<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('task.home', [
            'tasks' => $tasks,
        ]);
    }

    public function create(Request $request)
    {
        $validator = \Validator::make(
           $request->all(),
           [
               'name' => 'required|max:255',
           ]
        );
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $taskToSave = new Task;
        $taskToSave->name = $request->get('name');
        $taskToSave->save();
        return redirect('/');
    }

    public function remove(Task $task)
    {
        $task->delete();
        return redirect('/');
    }
}
