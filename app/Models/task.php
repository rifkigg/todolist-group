<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'board_id', 'project_id', 'status_id', 'priority_id', 'task_label_id', 'description', 'attachments', 'activities', 'checklist', 'time_count', 'due_date', 'created_by'];

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
        return $this->belongsTo(TaskPriority::class);
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

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function activities()
    {
        return $this->hasMany(TaskActivity::class);
    }

    public function checklist()
    {
        return $this->hasMany(TaskChecklist::class);
    }

    public function description()
    {
        return $this->hasMany(TaskDescription::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'task_name', 'name'); // Asumsi 'task_name' di History merujuk ke 'name' di Task
    }
}
