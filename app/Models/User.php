<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'email', 'password', 'username', 'role_id',
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
