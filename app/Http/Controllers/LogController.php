<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Carbon\Carbon;
use App\Log as Logger;
use App\Mail\ConfirmLog;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($comment, $taskId)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $data = [
            'comment'       => $comment,
            'task_id'       => $taskId,
            'date_comment'  => $date
        ];

        Logger::create($data);

        $nameTask = Task::select('name')
            ->where('id', $taskId)
            ->first();
        
        $data = Arr::add($data, 'nameTask', $nameTask->name);

        $this->sendMailConfirmation($taskId, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Logger $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Logger $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logger $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logger $log)
    {
        //
    }

    /**
     * @param int $taskId
     * @param Array $data
     * 
     */
    protected function sendMailConfirmation(int $taskId, Array $data)
    {
        $taskUserId = Task::select('user_id')
            ->where('id', $taskId)
            ->first();

        $userMail = User::select('email')
            ->where('id', $taskUserId->user_id)
            ->first();

        Mail::to($userMail)->send(new ConfirmLog($data));
    }
}
