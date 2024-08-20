<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'project_name', 'status_id', 'priority_id', 'task_label_id', 'user_id', 'due_date',
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function priority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    public function label()
    {
        return $this->belongsTo(TaskLabel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function board()
    {
        return $this->hasMany(Board::class);
    }
}
