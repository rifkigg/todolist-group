<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'group_name',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
