<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'status_id', 'live_date', 'project_detail',
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategories::class);
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class); // Relasi satu ke banyak
    }
}
