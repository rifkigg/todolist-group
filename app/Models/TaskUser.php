<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    protected $table = 'task_user';

    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'user_id',
    ];
}
