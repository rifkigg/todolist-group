<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email', 'password', 'username', 'role',
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, table: 'task_user');
    }
    public function projects()
    {
        return $this->belongsToMany(Task::class, table: 'project_users');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
