<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'comment',
        'date_comment',
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
