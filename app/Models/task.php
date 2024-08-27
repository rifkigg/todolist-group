<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'board_id',
        'project_id',
        'status_id',
        'priority_id',
        'task_label_id',
        'description',
        'attachments',
        'activities',
        'checklist',
        'time_count',
        'due_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function priority()
    {
        return $this->belongsTo(task_priority::class);
    }

    public function label()
    {
        return $this->belongsTo(TaskLabel::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }
}
