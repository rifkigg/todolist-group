<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'icon',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
