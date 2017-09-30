<?php

use Illuminate\Http\Request;
use App\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('task.home', [
        'tasks' => $tasks,
    ]);
});

Route::post('/task', function(Request $request) {
    $validator = Validator::make(
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
});

Route::delete('/task/{task}', function(Task $task) {
    $task->delete();

    return redirect('/');
});
