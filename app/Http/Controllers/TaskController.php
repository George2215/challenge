<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $date->format('Y-m-d');
        
        $tasks = Task::with('logs')->latest()->paginate(10);
        
        return view('home')->with([
            'tasks' => $tasks,
            'date' => $date
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        $selectedUserId = 0;

        return view('task.create')->with([
            'users' => $users,
            'selectedUserId' => $selectedUserId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $dataInput = $request->except('_token','comment');

        Task::create($dataInput);

        return redirect()->route('home')->with('message','Tarea creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $users = User::pluck('name', 'id');
        $selectedUserId = $task->user_id;

        return view('task.show')->with([
            'task' => $task, 
            'users' => $users, 
            'selectedUserId' => $selectedUserId
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::pluck('name', 'id');
        $selectedUserId = $task->user_id;

        return view('task.edit')->with([
            'task' =>$task,
            'users' => $users,
            'selectedUserId' => $selectedUserId
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $comment = $request->comment;

        $task->update($request->except('comment'));

        if ($request->filled('comment')) {
            app(LogController::class)->store($comment, $task->id);
        }

        return redirect()->route('home')->with('message','Tarea actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('home')->with('message','Tarea eliminada exitosamente.');
    }
}
