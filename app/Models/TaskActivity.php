<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskActivity extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'activity'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
